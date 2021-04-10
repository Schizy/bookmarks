<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class HttpExceptionsListener
{
    const SUPPORTED_EXCEPTIONS = [
        BadRequestHttpException::class => 400,
        NotEncodableValueException::class => 400,
        AccessDeniedHttpException::class => 403,
        NotFoundHttpException::class => 404,
        MethodNotAllowedHttpException::class => 405,
    ];

    const CUSTOM_MESSAGES = [
        404 => 'This resource does not exist.',
//        500 => 'Internal Server Error', //We can comment it in development to get the real errors
    ];

    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $exceptionType = get_class($exception);

        $status = self::SUPPORTED_EXCEPTIONS[$exceptionType] ?? 500;

        //Since we're an API, we ensure that we will return a JSON in EVERY case
        $event->setResponse(new JsonResponse([
            'status' => $status,
            'message' => self::CUSTOM_MESSAGES[$status] ?? $exception->getMessage(),
        ], $status));
    }
}
