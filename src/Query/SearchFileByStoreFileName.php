<?php


namespace App\Query;


use App\Common\CQRS\QueryInterface;

class SearchFileByStoreFileName implements QueryInterface
{
    private string $storedFileName;

    /**
     * SearchFileByStoreFileName constructor.
     * @param string $storedFileName
     */
    public function __construct(string $storedFileName)
    {
        $this->storedFileName = $storedFileName;
    }

    /**
     * @return string
     */
    public function getStoredFileName(): string
    {
        return $this->storedFileName;
    }

}