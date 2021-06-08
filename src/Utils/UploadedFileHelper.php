<?php


namespace App\Utils;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadedFileHelper
{
    private UploadedFile $uploadedFile;
    /** @required */
    public SluggerInterface $slugger;
    /** @required */
    public Filesystem $fileSystem;

    private string $storageDirectory;
    private ?string $storageGeneratedPath = null;
    private ?string $storageGeneratedName = null;


    /**
     * @param UploadedFile $uploadedFile
     */
    public function setUploadedFile(UploadedFile $uploadedFile): void
    {
        $this->storageGeneratedPath = null;
        $this->storageGeneratedName = null;
        $this->uploadedFile = $uploadedFile;
    }

    public function moveToStore()
    {
        $this->fileSystem->mkdir($this->storageGeneratedPath);
        $this->uploadedFile->move($this->getStoredPath(), $this->getStorageGeneratedName());
    }

    public function getClientSafeOriginalName()
    {
        return $this->slugger->slug($this->uploadedFile->getClientOriginalName());
    }

    public function getClientOriginalName()
    {
        return $this->uploadedFile->getClientOriginalName();
    }

    public function getStorageGeneratedName()
    {
        if (!$this->storageGeneratedName) {
            $this->storageGeneratedName = md5($this->getClientSafeOriginalName()) . '-' . uniqid() . '.' . $this->uploadedFile->guessExtension();
        }
        return $this->storageGeneratedName;
    }

    public function getStoredPath()
    {
        if (!$this->storageGeneratedPath) {
            return $this->generatePath();
        }
        return $this->storageGeneratedPath;
    }

    public function getMimeType()
    {
        return $this->uploadedFile->getMimeType();
    }

    public function getStoredRelativePath()
    {
        return str_replace($this->storageDirectory, '', $this->getStoredPath());
    }

    private function getSubPath($string): string
    {
        return substr(md5($string), 0, 3);
    }

    private function generatePath(): string
    {
        $tmpArray = [rtrim($this->storageDirectory, DIRECTORY_SEPARATOR)];
        $actualDate = date("Y-m-d");
        $actualHour = date("H");
        array_push($tmpArray, $this->getSubPath($actualDate), $this->getSubPath($actualHour));
        $this->storageGeneratedPath = implode(DIRECTORY_SEPARATOR, $tmpArray) . DIRECTORY_SEPARATOR;
        return $this->storageGeneratedPath;
    }

    public function guessExtension()
    {
        return $this->uploadedFile->guessExtension();
    }

    /**
     * @required
     * @param mixed $storageDirectory
     */
    public function setStorageDirectory(string $storageDirectory): void
    {
        $this->storageDirectory = $storageDirectory;
    }

}