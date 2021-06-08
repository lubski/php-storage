<?php


namespace App\Command;


use App\Common\CQRS\CommandInterface;
use DateTime;

class CreateFileCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $originalFileName;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $storedFilename;

    /**
     * @var string
     */
    private $storedPath;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var DateTime
     */
    private $addedDate;

    /**
     * @var DateTime
     */
    private $lastAccessDate;

    public function __construct(
        string $originalFileName,
        string $extension,
        string $storedFilename,
        string $storedPath,
        string $mimeType,
        DateTime $addedDate,
        DateTime $lastAccessDate
    )
    {
        $this->originalFileName = $originalFileName;
        $this->extension = $extension;
        $this->storedFilename = $storedFilename;
        $this->storedPath = $storedPath;
        $this->mimeType = $mimeType;
        $this->addedDate = $addedDate;
        $this->lastAccessDate = $lastAccessDate;
    }

    /**
     * @return string
     */
    public function getOriginalFileName(): string
    {
        return $this->originalFileName;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getStoredFilename(): string
    {
        return $this->storedFilename;
    }

    /**
     * @return string
     */
    public function getStoredPath(): string
    {
        return $this->storedPath;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return DateTime
     */
    public function getAddedDate(): DateTime
    {
        return $this->addedDate;
    }

    /**
     * @return DateTime
     */
    public function getLastAccessDate(): DateTime
    {
        return $this->lastAccessDate;
    }
}