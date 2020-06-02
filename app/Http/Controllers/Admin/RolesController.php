<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Interfaces\AdminMenu;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class RolesController
 *
 * @package App\Http\Controllers\Admin
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class RolesController extends Controller implements AdminMenu {

	/**
	 * Display list of roles
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function index() {
		Cache::store()->clear();

		$this->syncPermissions();

		$Roles = Role::query()->latest()->paginate( 20 );

		return view( 'admin.roles.index', compact( 'Roles' ) );
	}

	/**
	 * Display page to create role
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function createRole() {
		$Permissions = discover_permissions();

		return \view( 'admin.roles.create', compact( 'Permissions' ) );
	}

	/**
	 * Handle create role request
	 *
	 * @param CreateRoleRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function saveRole( CreateRoleRequest $request ): RedirectResponse {
		if ( ! $request->failed() ) {

			/**
			 * @var $Role Role
			 */
			$Role = Role::create( [
				'name'       => $request->role_name,
				'guard_name' => 'admin',
			] );

			if ( $Role !== null ) {
				$Role->givePermissionTo( $request->permissions );

				return redirect()->to( route( 'admin.roles.index' ) )->with( 'success', 'Role created successfully.' );
			}

			return redirect()->back()->withErrors( [ 'Could not create role, please try again later.' ] );
		}

		return redirect()->back()->withErrors( $request->errors() );
	}

	/**
	 * Display page to edit role
	 *
	 * @param Role $role
	 *
	 * @return Factory|View
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function editRole( Role $role ) {
		if ( $role->name !== 'super-admin' ) {
			$Permissions = discover_permissions();

			return \view( 'admin.roles.edit', compact( 'role', 'Permissions' ) );
		}

		return redirect()->back()->withErrors( [ 'Cannot edit super-admin role.' ] );
	}

	/**
	 * Handle update role request
	 *
	 * @param Role              $role
	 * @param UpdateRoleRequest $request
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function updateRole( Role $role, UpdateRoleRequest $request ): RedirectResponse {
		if ( $role->name !== 'super-admin' ) {
			if ( ! $request->failed() ) {

				$role->name = $request->role_name;
				$role->save();
				$role->syncPermissions( $request->permissions );

				return redirect()->back()->with( 'success', 'Role updated successfully.' );
			}

			return redirect()->back()->withErrors( $request->errors() );
		}

		return redirect()->back()->withErrors( [ 'Cannot edit super-admin role.' ] );
	}

	/**
	 * Handle delete role request
	 *
	 * @param Role $role
	 *
	 * @return RedirectResponse
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function deleteRoles( Role $role ): ?RedirectResponse {
		if ( $role->name !== 'super-admin' ) {
			try {
				$role->delete();

				return redirect()->back()->with( 'success', 'Role deleted successfully.' );
			} catch ( \Exception $e ) {
				return redirect()->back()->withErrors( [ 'Could not delete role.' ] );
			}
		}

		return redirect()->back()->withErrors( [ 'Cannot delete super-admin role.' ] );
	}

	/**
	 * Sync Discovered Permissions with Permissions in the database
	 *
	 * @return void
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function syncPermissions(): void {
		$FinalPermissions = discover_permissions( false );
		$RolesExists      = Permission::query()->whereIn( 'name', $FinalPermissions )->get();
		if ( $RolesExists->count() > 0 ) {
			$FinalPermissionsCollection = collect( $FinalPermissions )->filter( static function ( $item ) use ( $RolesExists ) {
				return ! $RolesExists->contains( 'name', '=', $item );
			} );
			$CreateRoles                = [];
			foreach ( $FinalPermissionsCollection as $finalPermission ) {
				$CreateRoles[] = [
					'name'       => $finalPermission,
					'guard_name' => 'admin',
					'updated_at' => Carbon::now(),
					'created_at' => Carbon::now(),
				];
			}
			if ( ! empty( $CreateRoles ) ) {
				Permission::query()->insert( $CreateRoles );
			}
		} else {
			$CreateRoles = [];
			foreach ( $FinalPermissions as $finalPermission ) {
				$CreateRoles[] = [
					'name'       => $finalPermission,
					'guard_name' => 'admin',
					'updated_at' => Carbon::now(),
					'created_at' => Carbon::now(),
				];
			}
			Permission::query()->insert( $CreateRoles );
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
				'text'     => 'ROLES',
				'order'      => 5,
				'permission' => 'manage-roles',
				'icon'       => 'fa fa-user-tag',
				'submenu'    => [
					[
						'text'       => 'Roles List',
						'route'      => 'admin.roles.index',
						'icon'       => 'fa fa-user-tag',
						'permission' => 'list-roles',
					],
					[
						'text'       => 'Create Role',
						'route'      => 'admin.roles.create',
						'icon'       => 'fa fa-plus-square',
						'permission' => 'create-roles',
					],
				]
			],
		];
	}
}
