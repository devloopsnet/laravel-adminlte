<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class Handler
 *
 * @package App\Exceptions
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [];

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
	 * @param \Exception $exception
	 *
	 * @return void
	 * @throws Exception
	 */
	public function report( Exception $exception ) {
		parent::report( $exception );
	}

	/**
	 * Convert an authentication exception into a response.
	 *
	 * @param Request                 $request
	 * @param AuthenticationException $exception
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	protected function unauthenticated( $request, AuthenticationException $exception ) {
		return $request->expectsJson() ? response()->json( [
			'status' => 0,
			'error'  => $exception->getMessage()
		], 401 ) : redirect()->guest( $exception->redirectTo() ?? route( 'admin.login' ) );
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param Request    $request
	 * @param \Exception $exception
	 *
	 * @return Response
	 * @throws \Exception
	 */
	public function render( $request, Exception $exception ) {
		return parent::render( $request, $exception );
	}
}
