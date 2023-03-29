<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    { if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
//                return redirect('/us/FourOFour123');
//                return redirect()->route('FourOFour123');

                $data = _404();
                return response()->view('web.home.index', $data, 404);
//               return view('web.home.index')->with($data);

            }
        }
        if ($exception instanceof TokenMismatchException) {
           // return redirect('/');
        }
        return parent::render($request, $exception);
    }
}
