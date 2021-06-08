<?php


namespace App\Controller;


use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Common\Repository\PersistenceLayerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppAbstractController extends AbstractController
{
    protected EventDispatcherInterface $eventDispatcher;
    protected CommandBusInterface $commandBus;
    protected QueryBusInterface $queryBus;
    protected PersistenceLayerInterface $repositoryLayer;

    public function __construct(EventDispatcherInterface $eventDispatcher, CommandBusInterface $commandBus, QueryBusInterface $queryBus, PersistenceLayerInterface $repositoryLayer)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->repositoryLayer = $repositoryLayer;
    }
}