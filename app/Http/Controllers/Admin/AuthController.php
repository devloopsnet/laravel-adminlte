<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LoginRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AuthController
 *
 *
 * @package App\Http\Controllers\Admin
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AuthController extends Controller {

	/**
	 * @var string
	 */
	private $redirectTo;

	public function __construct() {
		$this->redirectTo = route( 'admin.dashboard.index' );
	}

	/**
	 * Display Admin Login Page
	 *
	 * @return mixed
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function login() {
		if ( $this->guard()
		          ->user() === null ) {
			return view( 'auth.login' );
		}

		return redirect()->to( $this->redirectTo );
	}

	/**
	 * Authenticate Admin
	 *
	 * @param LoginRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function doLogin( LoginRequest $request ): RedirectResponse {
		if ( ! $request->failed() ) {

			$credentials = $request->only( 'email', 'password' );

			if ( $this->guard()
			          ->attempt( $credentials, $request->filled( 'remember' ) ) ) {

				admin()->last_login = Carbon::now();

				admin()->save();

				return redirect()->intended( $this->redirectTo );
			}

			return redirect()
				->back()
				->withErrors( [
					'email' => __( 'Invalid email or password.' ),
				] );
		}

		return redirect()
			->back()
			->withErrors( $request->errors() );
	}


	/**
	 * Log admin out and redirect back to login
	 *
	 * @return RedirectResponse|Redirector
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function logout() {

		$this->guard()
		     ->logout();

		return redirect( route( 'admin.login' ) );
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return StatefulGuard
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	protected function guard(): StatefulGuard {
		return Auth::guard( 'admin' );
	}

}
