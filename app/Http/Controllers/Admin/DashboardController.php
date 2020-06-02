<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateAppSettingsRequest;
use App\Http\Requests\Admin\UpdateSystemSettingsRequest;
use App\Interfaces\AdminMenu;
use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class DashboardController extends Controller implements AdminMenu {

	/**
	 * Dashboard home page
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function index() {
		return view( 'admin.dashboard.index' );
	}

	/**
	 * Redirect to dashboard
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function indexRedirect(): RedirectResponse {

		return redirect()->to( route( 'admin.dashboard.index' ) );
	}

	/**
	 * Display System & App settings page.
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function systemSettings() {
		return view( 'admin.dashboard.systemSettings' );
	}

	/**
	 * Handle update system settings request.
	 *
	 * @param UpdateSystemSettingsRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function saveSystemSettings( UpdateSystemSettingsRequest $request ): RedirectResponse {
		if ( ! $request->failed() ) {

			Setting::set( 'user_percentage', (double) $request->user_percentage );
			Setting::set( 'cash_out_threshold', (double) $request->cash_out_threshold );
			Setting::set( 'minimum_order_weight', (double) $request->minimum_order_weight );

			return redirect()->back()->with( 'success', 'System settings updated successfully.' );
		}

		return redirect()->back()->withErrors( $request->errors() );
	}

	/**
	 * Handle update app settings request.
	 *
	 * @param UpdateAppSettingsRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function saveAppSettings( UpdateAppSettingsRequest $request ): RedirectResponse {
		if ( ! $request->failed() ) {

			Setting::set( 'support_email', $request->support_email );
			Setting::set( 'mobile_phone', $request->mobile_phone );
			Setting::set( 'land_line', $request->land_line );
			Setting::set( 'ios_app_url', $request->ios_app_url );
			Setting::set( 'android_app_url', $request->android_app_url );
			Setting::set( 'twitter_account', $request->twitter_account );
			Setting::set( 'facebook_account', $request->facebook_account );
			Setting::set( 'instagram_account', $request->instagram_account );
			Setting::set( 'youtube_account', $request->youtube_account );
			Setting::set( 'linkedin_account', $request->linkedin_account );
			Setting::set( 'brief', $request->brief );
			Setting::set( 'address', $request->address );
			Setting::set( 'faq', $request->faq );

			Setting::set( 'brief_ar', $request->brief_ar );
			Setting::set( 'address_ar', $request->address_ar );
			Setting::set( 'faq_ar', $request->faq_ar );

			if ( $request->privacy_policy !== null ) {
				if ( Setting::get( 'privacy_policy' ) !== null ) {
					Storage::delete( Setting::get( 'privacy_policy' ) );
				}
				Setting::set( 'privacy_policy', $request->privacy_policy->store( 'settings/privacy_policy', [ 'disk' => 's3' ] ) );
			}

			if ( $request->terms_conditions !== null ) {
				if ( Setting::get( 'terms_conditions' ) !== null ) {
					Storage::delete( Setting::get( 'terms_conditions' ) );
				}
				Setting::set( 'terms_conditions', $request->terms_conditions->store( 'settings/terms_conditions', [ 'disk' => 's3' ] ) );
			}

			return redirect()->back()->with( 'success', 'App settings updated successfully.' );
		}

		return redirect()->back()->withErrors( $request->errors() );
	}

	/**
	 * Handle clear cache request
	 *
	 * @return RedirectResponse
	 */
	public function clearCache(): RedirectResponse {
		Cache::store( config( 'cache.default' ) )->clear();

		return redirect()->to( route( 'admin.dashboard.index' ) )->with( 'success', 'Cache cleared.' );
	}

	/**
	 * Return admin menu
	 *
	 * @return array
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public static function getMenu(): array {
		return [
			[
				'text'       => 'DASHBOARD',
				'order'      => 0,
				'icon'       => 'fa fa-tachometer-alt',
				'permission' => 'manage-dashboard',
				'submenu'    => [
					[
						'text'       => 'Dashboard',
						'route'      => 'admin.dashboard.index',
						'icon'       => 'fa fa-home',
						'permission' => 'view-dashboard',
					],
					[
						'text'       => 'Clear Cache',
						'route'      => 'admin.dashboard.clearCache',
						'icon'       => 'fa fa-broom',
						'permission' => 'clear-cache-dashboard',
					],
					[
						'text'       => 'System & App Settings',
						'route'      => 'admin.dashboard.systemSettings',
						'icon'       => 'fa fa-cogs',
						'permission' => 'system-settings',
					],
				]
			],
		];
	}
}
