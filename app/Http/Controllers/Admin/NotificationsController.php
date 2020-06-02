<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shopper;
use Exception;
use App\Http\Requests\Admin\CreateNotificationRequest;
use App\Interfaces\AdminMenu;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

/**
 * Class NotificationsController
 *
 * @package App\Http\Controllers\Admin
 * @date 2019-07-13
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class NotificationsController extends Controller implements AdminMenu {

  /**
   * Display all system-sent notifications
   *
   * @return Factory|View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function index() {
    $Notifications = \App\Models\SystemNotification::query()->latest()->paginate(20);

    return view('admin.notifications.index', compact('Notifications'));
  }

  /**
   * Display notification details page
   *
   * @param \App\Models\SystemNotification $system_notification
   *
   * @return Factory|View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function viewNotification(\App\Models\SystemNotification $system_notification) {
    $Users = collect([]);
    if ($system_notification->send_to_users !== '') {
      $Users = User::query()->whereIn('id', explode(',', $system_notification->send_to_users))->get();
    }


    return view('admin.notifications.view', compact('system_notification', 'Users'));
  }

  /**
   * Display page to create and send new notification
   *
   * @return Factory|View
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function createNotification() {
    $Users = User::all();
    $Shoppers = Shopper::all();

    return view('admin.notifications.create', compact('Users', 'Shoppers'));
  }

  /**
   * Handle send notification request
   *
   * @param CreateNotificationRequest $request
   *
   * @return RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function sendNotification(CreateNotificationRequest $request): RedirectResponse {
    if (!$request->failed()) {
      $Users = collect([]);

      switch ($request->send_to) {
        case 'all':
          if (in_array('0', $request->users, FALSE)) {
            $Users = User::all();
          } else {
            $Users = User::query()->whereIn('id', collect($request->users)
              ->filter(static function ($userId) {
                return (int) $userId > 0;
              })->toArray())->select('id', 'firebase_token', 'name', 'locale', 'user_type', 'email')
              ->get();
          }

          break;
        case 'users':
          if (in_array('0', $request->users, FALSE)) {
            $Users = User::query()->select('id', 'firebase_token', 'name', 'locale', 'user_type', 'email')
              ->get();
          } else {
            $Users = User::query()->whereIn('id', collect($request->users)
              ->filter(static function ($userId) {
                return (int) $userId > 0;
              })->toArray())->select('id', 'firebase_token', 'name', 'locale', 'user_type', 'email')
              ->get();
          }
          break;
      }

      /**
       * @var $SystemNotification \App\Models\SystemNotification
       */
      $SystemNotification = admin()->system_notifications()->create([
                                                                      'title' => [
                                                                        'ar' => $request->title_ar,
                                                                        'en' => $request->title_en,
                                                                      ],
                                                                      'body' => [
                                                                        'ar' => $request->body_ar,
                                                                        'en' => $request->body_en,
                                                                      ],
                                                                      'send_to_drivers' => '',
                                                                      'send_to_users' => $Users->pluck('id')->implode(','),
                                                                    ]);

      if ($SystemNotification !== NULL) {
        try {
          if ($Users->count() > 0) {
            Notification::send($Users, new SystemNotification($SystemNotification));
          }
        } catch (Exception $e) {
        }

        return redirect()->to(route('admin.notifications.index'))
          ->with('success', __('Notification sent.'));
      }

      return redirect()->back()->withErrors([__('Could not create notification.')]);
    }

    return redirect()->back()->withErrors($request->errors());
  }

  /**
   * Handle request to delete notification
   *
   * @param \App\Models\SystemNotification $system_notification
   *
   * @return RedirectResponse
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function deleteNotification(\App\Models\SystemNotification $system_notification): ?RedirectResponse {
    try {
      $system_notification->delete();
      /**
       * delete users & drivers notifications as well.
       */
      DatabaseNotification::with('type', '=', \App\Models\SystemNotification::class)->delete();

      return redirect()->to(route('admin.notifications.index'))
        ->with('success', __('Notification deleted.'));
    } catch (Exception $exception) {
      return redirect()->to(route('admin.notifications.index'))
        ->withErrors([__('Could not delete notification.')]);
    }
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
        'text' => 'NOTIFICATIONS',
        'order' => 4,
        'permission' => 'manage-notifications',
        'icon' => 'fa fa-bell',
        'submenu' => [
          [
            'text' => 'Notifications List',
            'route' => 'admin.notifications.index',
            'icon' => 'fa fa-bell',
            'permission' => 'view-notifications',
          ],
          [
            'text' => 'Send Notification',
            'route' => 'admin.notifications.create',
            'icon' => 'fa fa-plus-square',
            'permission' => 'send-notifications',
          ],
        ],
      ],
    ];
  }

}
