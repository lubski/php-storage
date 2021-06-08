<?php


namespace App\Common\Repository;


interface PersistenceLayerInterface
{
    public function add($entity);

    public function remove($entity);

    public function commit();

    public function rollback();
}