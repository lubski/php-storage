<?php

namespace App\Controller;

use App\Entity\StoreFile;
use App\Exceptions\ImageNotFoundException;
use App\Query\SearchFileByStoreFileName;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadController extends AppAbstractController
{
    /**
     * @Route("/read/{file}", name="read", requirements={"file"=".+"})
     */
    public function index(string $file, string $storageDirectory): Response
    {
        /**
         * @var StoreFile $storeFile
         */
        $storeFile = $this->queryBus->handle(new SearchFileByStoreFileName($file));
        if(!$storeFile) {
            throw new ImageNotFoundException("Resource not exists");
        }

        $absolutePath = $storageDirectory.$storeFile->getStoredPath().$storeFile->getStoredFilename();
        if(!file_exists($absolutePath)) {
            throw new ImageNotFoundException("Resource not exists");
        }

        $file = new File($absolutePath);
        return new BinaryFileResponse($file);
    }
}
