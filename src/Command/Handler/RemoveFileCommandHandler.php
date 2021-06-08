<?php


namespace App\Command\Handler;


use App\Command\RemoveFileCommand;
use App\Common\CQRS\CommandHandlerInterface;
use App\Common\Repository\PersistenceLayerInterface;

class RemoveFileCommandHandler implements CommandHandlerInterface
{
    private PersistenceLayerInterface $storeFileRepository;

    public function __construct(PersistenceLayerInterface $storeFileRepository)
    {
        $this->storeFileRepository = $storeFileRepository;
    }

    public function __invoke(RemoveFileCommand $command)
    {

    }
}