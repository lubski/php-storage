<?php

namespace App\Controller;

use App\Entity\StoreFile;
use App\Query\SearchFileByStoreFileName;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class DownloadController extends AppAbstractController
{
    /**
     * @Route("/download/{file}", name="download", requirements={"file"=".+"})
     */
    public function index(string $file, string $storageDirectory): Response
    {
        /**
         * @var StoreFile $storeFile
         */
        $storeFile = $this->queryBus->handle(new SearchFileByStoreFileName($file));
        $absolutePath = $storageDirectory.$storeFile->getStoredPath().$storeFile->getStoredFilename();
        if(!file_exists($absolutePath)) {
            throw new NotFoundHttpException("Resource not exists");
        }
        $file = new File($absolutePath);
        $response = new BinaryFileResponse($file);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            (new File($absolutePath))->getFilename()
        );
        $response->headers->set('Content-Disposition', $disposition);

        return $response;

    }
}
