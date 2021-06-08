<?php

namespace App\Controller;

use App\Command\CreateFileCommand;
use App\Utils\UploadedFileHelper;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UploadController extends AppAbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function index(Request $request, UploadedFileHelper $fileUploader): Response
    {
        $files = [];
        foreach ($request->files as $file) {
            if (!is_array($file)) {
                $file[] = $file;
            }
            /**
             * @var UploadedFile $f
             */
            foreach ($file as $f) {
                $fileUploader->setUploadedFile($f);
                $command = new CreateFileCommand(
                    $fileUploader->getClientOriginalName(),
                    $fileUploader->guessExtension(),
                    $fileUploader->getStorageGeneratedName(),
                    $fileUploader->getStoredRelativePath(),
                    $fileUploader->getMimeType(),
                    new \DateTime(),
                    new \DateTime()
                );
                $fileUploader->moveToStore();
                $files[] = $fileUploader->getStorageGeneratedName();
                $this->commandBus->dispatch($command);
            }
        }
        $this->repositoryLayer->commit();

        return $this->json([
            'success' => true,
            'files' => array_map(function ($file) {
                return ["links" => [
                    'read' => $this->generateUrl('read',  ['file' => $file],UrlGeneratorInterface::ABSOLUTE_URL),
                    'download' => $this->generateUrl('download',  ['file' => $file],UrlGeneratorInterface::ABSOLUTE_URL),
                    'delete' => $this->generateUrl('delete',  ['file' => $file],UrlGeneratorInterface::ABSOLUTE_URL)
                ]];
            },$files)
        ]);
    }
}
