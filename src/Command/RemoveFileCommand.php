<?php


namespace App\Command;


use App\Common\CQRS\CommandInterface;

class RemoveFileCommand implements CommandInterface
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