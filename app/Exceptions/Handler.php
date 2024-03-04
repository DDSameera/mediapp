<?php

namespace App\Exceptions;

use App\Services\Api\v1\ResponseService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Validation\ValidationException;



use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, \Throwable $exception)
    {


        // Handle UniqueConstraintViolationException
        if ($exception instanceof UniqueConstraintViolationException) {
            return ResponseService::errorResponse('Username already exists',  409);
        }


        //Resource Not Found
        if ($exception instanceof ModelNotFoundException) {
            return ResponseService::errorResponse('Record not exsist',  409);
        }


        // Handle ValidationException
        if ($exception instanceof ValidationException) {
            return ResponseService::errorResponse($exception->errors(), 422);
        }

        //Unauthorized Access
        if ($exception instanceof AuthorizationException) {
            return ResponseService::errorResponse(['error' => $exception->getMessage()],  409);
        }

        // For all other exceptions, return a generic error response
        return ResponseService::errorResponse($exception->getMessage(),  500);

        // return parent::render($request, $exception);
    }
}
