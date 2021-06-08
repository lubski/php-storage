<?php

namespace App\Controller;

use App\Query\SearchFileByStoreFileName;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DeleteController extends AppAbstractController
{
    /**
     * @Route("/delete/{file}", name="delete", methods={"DELETE"}, requirements={"file"=".+"})
     */
    public function index(string $file, string $storageDirectory): Response
    {
        $storeFile = $this->queryBus->handle(new SearchFileByStoreFileName($file));
        $absolutePath = $storageDirectory.$storeFile->getStoredPath().$storeFile->getStoredFilename();
        if(!file_exists($absolutePath)) {
            throw new NotFoundHttpException("Resource not exists");
        }

        if(unlink($absolutePath)) {
            return $this->json([
                'success' => true,
                'message' => 'Resource has been deleted',
            ]);
        }
    }
}
