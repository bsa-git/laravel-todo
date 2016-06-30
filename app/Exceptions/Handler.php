<?php

namespace App\Exceptions;

use Exception;
use \Illuminate\Session\TokenMismatchException as InvalidTokensCSRF;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        InvalidTokensCSRF::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e) {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e) {
        $statusCode = $this->getStatusCode($e);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => $this->getMessage($e)], $statusCode);
        }

        // in debug mode displays all errors as they are
        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        // if it is a descendant \Symfony\Component\HttpKernel\Exception\HttpException
        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        }

        // otherwise show a standard error page 500
        return response()->view('errors.500', [], 500);
    }

    /**
     * Get Exception status code
     * 
     * @param Exception $e
     * @return int
     */
    protected function getStatusCode(\Exception $e) {
        if ($e instanceof HttpException) {
            return $e->getStatusCode();
        }

        return 500;
    }

    /**
     * Get Exception message
     * 
     * @param Exception $e
     * @return string
     */
    protected function getMessage(\Exception $e) {
        
        return $e->getMessage();

    }

}
