<?php


namespace App\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Query\SearchFileByStoreFileName;
use Doctrine\ORM\EntityManagerInterface;

class SearchFileByStoreFileNameHandler implements QueryHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(SearchFileByStoreFileName $query)
    {
        $queryObject = $this->entityManager->createQuery(
        'SELECT s
            FROM App\Entity\StoreFile s
            WHERE s.storedFilename = :storedFilename'
            )->setParameter('storedFilename', $query->getStoredFileName());

        return $queryObject->setMaxResults(1)->getOneOrNullResult();
    }
}