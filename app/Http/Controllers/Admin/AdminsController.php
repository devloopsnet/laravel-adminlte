<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use App\Interfaces\AdminMenu;
use App\Models\Admin;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

/**
 * Class AdminsController
 *
 * @package App\Http\Controllers\Admin
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AdminsController extends Controller implements AdminMenu {

	/**
	 * Display page to list all administrators
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function index() {
		$Admins = Admin::query()->latest()->paginate( 20 );

		return view( 'admin.admins.index', compact( 'Admins' ) );
	}

	/**
	 * Display page to create a new administrator
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function createAdmin() {
		$Roles = Role::all();

		return \view( 'admin.admins.create', compact( 'Roles' ) );
	}

	/**
	 * Handle create admin request
	 *
	 * @param CreateAdminRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function saveAdmin( CreateAdminRequest $request ): RedirectResponse {
		if ( ! $request->failed() ) {

			/**
			 * @var $Admin Admin
			 */
			$Admin = Admin::query()->create( [
				'name'     => $request->name,
				'email'    => $request->email,
				'password' => Hash::make( $request->password ),
			] );

			if ( $Admin ) {
				$Admin->assignRole( $request->roles );

				return redirect()->to( route( 'admin.admins.index' ) )
				                 ->with( 'success', 'Admin created successfully.' );
			}

			return redirect()->back()->withErrors( [ 'Could not create admin, please try again later.' ] );
		}

		return redirect()->back()->withErrors( $request->errors() );
	}

	/**
	 * Display edit admin page
	 *
	 * @param Admin $admin
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function editAdmin( Admin $admin ) {
		$Roles = Role::all();

		return \view( 'admin.admins.edit', compact( 'admin', 'Roles' ) );
	}

	/**
	 * Handle update admin request
	 *
	 * @param Admin              $admin
	 * @param UpdateAdminRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function updateAdmin( Admin $admin, UpdateAdminRequest $request ): RedirectResponse {
		if ( ! $request->failed() ) {

			$admin->name  = $request->name;
			$admin->email = $request->email;
			if ( $request->password !== null ) {
				$admin->password = Hash::make( $request->password );
			}

			$admin->syncRoles( $request->roles );

			$admin->save();

			return redirect()->back()->with( 'success', 'Admin updated successfully.' );

		}

		return redirect()->back()->withErrors( $request->errors() );
	}

	/**
	 * Handle delete admin request
	 *
	 * @param Admin $admin
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function deleteAdmin( Admin $admin ): ?RedirectResponse {
		try {
			$admin->delete();

			return redirect()->back()->with( 'success', 'Administrator deleted successfully.' );
		} catch ( \Exception $e ) {
			return redirect()->back()->withErrors( [ 'Could not delete administrator.' ] );
		}
	}

	/**
	 * Return menu for admin
	 *
	 * @return array
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public static function getMenu(): array {
		return [
			[
				'text'       => 'ADMINISTRATORS',
				'order'      => 3,
				'icon'       => 'fa fa-user-shield',
				'permission' => 'manage-administrators',
				'submenu'    => [
					[
						'text'       => 'Administrators List',
						'route'      => 'admin.admins.index',
						'icon'       => 'fa fa-user-shield',
						'permission' => 'list-administrators',
					],
					[
						'text'       => 'Creat Administrators',
						'route'      => 'admin.admins.create',
						'icon'       => 'fa fa-plus-square',
						'permission' => 'create-administrators',
					],
				]
			],
		];
	}
}
