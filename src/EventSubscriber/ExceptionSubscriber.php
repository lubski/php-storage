<?php


namespace App\EventSubscriber;

use App\Exceptions\ImageNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private string $assetsDirectory; 

    public function __construct(string $assetsDirectory)
    {
        $this->assetsDirectory = $assetsDirectory;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION=> 'processException'
        ];
    }

    public function processException(ExceptionEvent $event)
    {
        $throwable = $event->getThrowable();
        if($throwable instanceof ImageNotFoundException) {
            $file = new File($this->assetsDirectory."errors".DIRECTORY_SEPARATOR."404-error-page.png");
            $response = new Response(file_get_contents($file), Response::HTTP_OK, ['Content-type' => 'image/png']);
            $event->setResponse($response);
        }
    }
}