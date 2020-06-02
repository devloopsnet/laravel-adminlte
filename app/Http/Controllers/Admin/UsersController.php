<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Interfaces\AdminMenu;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Admin
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UsersController extends Controller implements AdminMenu {

  /**
   * List all users
   *
   * @return Factory|View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function index() {
    $Users = User::applySearch()->latest()->paginate(20)->appends($_GET);

    return view('admin.users.index', compact('Users'));
  }

  /**
   * List all users
   *
   * @return Factory|View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function trashedIndex() {
    $Users = User::applySearch()->onlyTrashed()->latest()->paginate(20)->appends($_GET);

    return view('admin.users.trashed', compact('Users'));
  }

  /**
   * Display user profile
   *
   * @param \App\Models\User $user
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function viewUser(User $user) {
    return view('admin.users.view', compact('user'));
  }

  /**
   * Handle delete user request
   *
   * @param User $user
   *
   * @return RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function deleteUser(User $user): ?RedirectResponse {
    try {
      $user->delete();

      return redirect()->back()->with('success', 'User Deleted successfully.');
    } catch (\Exception $exception) {
      return redirect()->back()->withErrors(['Could not delete user.']);
    }
  }

  /**
   * Handle restore user request
   *
   * @param int $user
   *
   * @return RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function restoreUser(int $user): ?RedirectResponse {
    $user = User::onlyTrashed()->find($user);
    if ($user !== NULL) {
      $user->restore();

      return redirect()->to(route('admin.users.index'))->with('success', 'Users restored successfully.');
    }

    return redirect()->back()->withErrors(['User not found.']);
  }

  /**
   * Display page to create user
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function createUser() {
    return view('admin.users.create');
  }

  /**
   * Handle user creation request
   *
   * @param \App\Http\Requests\Admin\User\CreateUserRequest $request
   *
   * @return \Illuminate\Http\RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function storeUser(CreateUserRequest $request): RedirectResponse {
    if (!$request->failed()) {
      $User = User::query()->create([
                                      'first_name' => $request->first_name,
                                      'last_name' => $request->last_name,
                                      'phone_number' => $request->phone_number,
                                      'email' => $request->email,
                                      'gender' => $request->gender,
                                      'wallet' => $request->wallet_balance,
                                      'points' => $request->reward_points,
                                      'status' => $request->status,
                                      'password' => Hash::make($request->password),
                                    ]);
      if ($User !== NULL) {
        return redirect()->to(route('admin.users.index'))
          ->with('success', __('User created successfully.'));
      }

      return redirect()->back()->withInput()->withErrors([__('Could not create user.')]);
    }

    return redirect()->back()->withInput()->withErrors($request->errors()->all());
  }

  /**
   * Display page to edit user
   *
   * @param User $user
   *
   * @return Factory|View|RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function editUser(User $user) {
    return \view('admin.users.edit', compact('user'));
  }

  /**
   * Handle update user request
   *
   * @param User $user
   * @param UpdateUserRequest $request
   *
   * @return RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function updateUser(User $user, UpdateUserRequest $request): RedirectResponse {
    if (!$request->failed()) {
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->phone_number = $request->phone_number;
      $user->email = $request->email;
      $user->wallet = $request->wallet_balance;
      $user->points = $request->reward_points;
      $user->status = $request->status;

      if ($request->password !== NULL) {
        $user->password = Hash::make($request->password);
      }

      $user->save();

      return redirect()->back()->with('success', __('User :name updated successfully.', [
        'name' => $user->full_name,
      ]));
    }

    return redirect()->back()->withErrors($request->errors());
  }

  /**
   * Handle user_address deletion request
   *
   * @param \App\Models\User $user
   * @param \App\Models\UserAddress $user_address
   *
   * @return \Illuminate\Http\RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function deleteUserAddress(User $user, UserAddress $user_address): ?RedirectResponse {
    try {
      $user_address->delete();

      return redirect()->back()->with('success', __('User address deleted successfully.'));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors([
                                              __('Could not delete user address.'),
                                            ]);
    }
  }

  /**
   * Handle user_credit_card deletion request
   *
   * @param \App\Models\User $user
   * @param \App\Models\UserCreditCard $user_credit_card
   *
   * @return \Illuminate\Http\RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function deleteUserCreditCard(User $user, UserCreditCard $user_credit_card): ?RedirectResponse {
    try {
      $user_credit_card->delete();

      return redirect()->back()->with('success', __('User credit card deleted successfully.'));
    } catch (\Exception $e) {
      return redirect()->back()->withErrors([
                                              __('Could not delete user credit card.'),
                                            ]);
    }
  }

  /**
   * Return menu for admin side
   *
   * @return array
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public static function getMenu(): array {
    return [
      [
        'text' => 'USERS',
        'order' => 2.5,
        'icon' => 'fa fa-user',
        'permission' => 'manage-customers',
        'submenu' => [
          [
            'text' => 'Users List',
            'route' => 'admin.users.index',
            'icon' => 'fa fa-user',
            'permission' => 'list-customers',
          ],
          [
            'text' => 'Deleted Users List',
            'route' => 'admin.users.trashed',
            'icon' => 'fa fa-user-times',
            'permission' => 'list-deleted-customers',
          ],
          [
            'text' => 'Create User',
            'route' => 'admin.users.create',
            'icon' => 'fa fa-user-plus',
            'permission' => 'create-customers',
          ],
        ],
      ],
    ];
  }

}
