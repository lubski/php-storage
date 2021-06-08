<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private SluggerInterface $slugger;
    private string $generateSafeName;
    private RandomPath $randomPath;
    private string $storageDirectory;

    public function __construct(SluggerInterface $slugger, RandomPath $randomPath, string $storageDirectory)
    {
        $this->slugger = $slugger;
        $this->randomPath = $randomPath;
        $this->storageDirectory = $storageDirectory;
    }

    public function upload(UploadedFile $file): string
    {
        $destDir = $this->storageDirectory.$this->randomPath->generatePath();
        $file->move($destDir, $this->generateSafeName);
        return $this->generateSafeName;
    }

    /**
     * @return SluggerInterface
     */
    public function getSlugger(): SluggerInterface
    {
        return $this->slugger;
    }

    /**
     * @return RandomPath
     */
    public function getRandomPath(): RandomPath
    {
        return $this->randomPath;
    }

    /**
     * @return string
     */
    public function getGenerateSafeName(): string
    {
        return $this->generateSafeName;
    }

    /**
     * @param UploadedFile $file
     */
    public function setGenerateSafeName(UploadedFile $file): void
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->getSlugger()->slug($originalFilename);
        $this->generateSafeName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
    }
}