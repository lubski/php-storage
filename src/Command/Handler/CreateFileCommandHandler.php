<?php


namespace App\Command\Handler;


use App\Command\CreateFileCommand;
use App\Common\CQRS\CommandHandlerInterface;
use App\Common\Repository\PersistenceLayerInterface;
use App\Entity\StoreFile;

class CreateFileCommandHandler implements CommandHandlerInterface
{
    private PersistenceLayerInterface $storeFileRepository;

    public function __construct(PersistenceLayerInterface $storeFileRepository)
    {
        $this->storeFileRepository = $storeFileRepository;
    }

    public function __invoke(CreateFileCommand $createFileCommand)
    {
        $storeFile = new StoreFile();
        $storeFile->setOriginalFileName($createFileCommand->getOriginalFileName());
        $storeFile->setExtension($createFileCommand->getExtension());
        $storeFile->setStoredFilename($createFileCommand->getStoredFilename());
        $storeFile->setStoredPath($createFileCommand->getStoredPath());
        $storeFile->setMimeType($createFileCommand->getMimeType());
        $storeFile->setAddedDate($createFileCommand->getAddedDate());
        $storeFile->setLastAccessDate($createFileCommand->getLastAccessDate());

        $this->storeFileRepository->add($storeFile);
    }


}