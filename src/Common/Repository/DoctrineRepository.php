<?php


namespace App\Common\Repository;


use Doctrine\ORM\EntityManagerInterface;

final class DoctrineRepository implements PersistenceLayerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityManager->beginTransaction();
    }

    public function commit()
    {
        $this->entityManager->flush();
        $this->entityManager->getConnection()->commit();
    }

    public function rollback()
    {
        $this->entityManager->rollback();
    }

    public function add($entity)
    {
        if (!$this->entityManager->contains($entity)) {
            $this->entityManager->persist($entity);
        }
    }

    public function remove($entity)
    {
        $this->entityManager->remove($entity);
    }
}