<?php


namespace App\Service;


use Symfony\Component\Filesystem\Filesystem;

class RandomPath
{
    /**
     * @var Filesystem
     */
    private Filesystem $filesystem;
    private string $storageDirectory;
    private ?string $absolutePath = null;

    /**
     * RandomPath constructor.
     */
    public function __construct(Filesystem $fileSystem, string $storageDirectory)
    {
        $this->filesystem = $fileSystem;
        $this->storageDirectory = $storageDirectory;
    }

    public function generatePath($makePath = true): string
    {
        $tmpArray = [rtrim($this->getStorageDirectory(), DIRECTORY_SEPARATOR)];
        $actualDate = date("Y-m-d");
        $actualHour = date("H");
        array_push($tmpArray, $this->getSubPath($actualDate), $this->getSubPath($actualHour));
        $tmpPathString = implode(DIRECTORY_SEPARATOR, $tmpArray).DIRECTORY_SEPARATOR;
        $this->setAbsolutePath($tmpPathString);
        if($makePath) {
            $this->getFilesystem()->mkdir($tmpPathString);
        }

        return $tmpPathString;
    }

    private function getSubPath($string): string {
        return substr(md5($string), 0, 3);
    }

    /**
     * @return Filesystem
     */
    public function getFilesystem(): Filesystem
    {
        return $this->filesystem;
    }

    /**
     * @return string
     */
    public function getStorageDirectory(): string
    {
        return $this->storageDirectory;
    }

    /**
     * @return string|null
     */
    public function getAbsolutePath(): ?string
    {
        return $this->absolutePath;
    }

    /**
     * @param string $absolutePath
     */
    public function setAbsolutePath(string $absolutePath): void
    {
        $this->absolutePath = $absolutePath;
    }

    public function getRelativePath() {
        return str_replace($this->getStorageDirectory(), '', $this->getAbsolutePath());
    }

}