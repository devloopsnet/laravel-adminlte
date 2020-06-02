<?php

//Route::domain( 'admin.' . env( 'APP_DOMAIN' ) )
Route::prefix('admin')->name('admin.')->group(static function () {
  Route::middleware('guest')->group(static function () {
    Route::get('login', [
      'as' => 'login', 'uses' => 'Admin\AuthController@login',
    ]);

    Route::post('login', [
      'as' => 'doLogin', 'uses' => 'Admin\AuthController@doLogin',
    ]);
  });

  Route::middleware('auth:admin')->group(static function () {
    Route::get('', [
      'as' => 'index', 'uses' => 'Admin\DashboardController@indexRedirect',
    ]);

    Route::post('logout', [
      'as' => 'logout', 'uses' => 'Admin\AuthController@logout',
    ]);

    Route::prefix('dashboard')->name('dashboard.')->group(static function () {
      Route::get('/', [
        'as' => 'index', 'uses' => 'Admin\DashboardController@index',
        'permission' => 'manage-dashboard',
      ]);

      Route::get('system-settings', [
        'as' => 'systemSettings',
        'uses' => 'Admin\DashboardController@systemSettings',
        'permission' => 'system-settings',
      ]);

      Route::post('save-system-settings', [
        'as' => 'saveSystemSettings',
        'uses' => 'Admin\DashboardController@saveSystemSettings',
        'permission' => 'update-system-settings',
      ]);

      Route::post('save-app-settings', [
        'as' => 'saveAppSettings',
        'uses' => 'Admin\DashboardController@saveAppSettings',
        'permission' => 'update-app-settings',
      ]);

      Route::get('clearCache', [
        'as' => 'clearCache',
        'uses' => 'Admin\DashboardController@clearCache',
        'permission' => 'clear-cache-dashboard',
      ]);
    });

    Route::prefix('notifications')->name('notifications.')->group(static function () {
      Route::get('', [
        'as' => 'index', 'uses' => 'Admin\NotificationsController@index',
        'permission' => 'view-notifications',
      ]);

      Route::get('create', [
        'as' => 'create',
        'uses' => 'Admin\NotificationsController@createNotification',
        'permission' => 'send-notifications',
      ]);

      Route::post('create', [
        'as' => 'send',
        'uses' => 'Admin\NotificationsController@sendNotification',
        'permission' => 'send-notifications',
      ]);

      Route::prefix('{system_notification}')->group(static function () {
        Route::get('', [
          'as' => 'view',
          'uses' => 'Admin\NotificationsController@viewNotification',
          'permission' => 'view-notifications',
        ]);

        Route::get('delete', [
          'as' => 'delete',
          'uses' => 'Admin\NotificationsController@deleteNotification',
          'permission' => 'delete-notifications',
        ]);
      });
    });

    Route::prefix('administrators')->name('admins.')->group(static function () {
      Route::get('/', [
        'as' => 'index', 'uses' => 'Admin\AdminsController@index',
        'permission' => 'list-administrators',
      ]);

      Route::get('create', [
        'as' => 'create', 'uses' => 'Admin\AdminsController@createAdmin',
        'permission' => 'create-administrators',
      ]);

      Route::post('create', [
        'as' => 'save', 'uses' => 'Admin\AdminsController@saveAdmin',
        'permission' => 'create-administrators',
      ]);

      Route::prefix('{admin}')->group(static function () {
        Route::get('delete', [
          'as' => 'delete', 'uses' => 'Admin\AdminsController@deleteAdmin',
          'permission' => 'delete-administrators',
        ]);

        Route::get('edit', [
          'as' => 'edit', 'uses' => 'Admin\AdminsController@editAdmin',
          'permission' => 'edit-administrators',
        ]);

        Route::post('edit', [
          'as' => 'update', 'uses' => 'Admin\AdminsController@updateAdmin',
          'permission' => 'edit-administrators',
        ]);
      });
    });

    Route::prefix('roles')->name('roles.')->group(static function () {
      Route::get('/', [
        'as' => 'index', 'uses' => 'Admin\RolesController@index',
        'permission' => 'list-roles',
      ]);

      Route::get('create', [
        'as' => 'create', 'uses' => 'Admin\RolesController@createRole',
        'permission' => 'create-roles',
      ]);

      Route::post('create', [
        'as' => 'save', 'uses' => 'Admin\RolesController@saveRole',
        'permission' => 'create-roles',
      ]);

      Route::prefix('{role}')->group(static function () {
        Route::get('delete', [
          'as' => 'delete', 'uses' => 'Admin\RolesController@deleteRoles',
          'permission' => 'delete-roles',
        ]);

        Route::get('edit', [
          'as' => 'edit', 'uses' => 'Admin\RolesController@editRole',
          'permission' => 'edit-roles',
        ]);

        Route::post('edit', [
          'as' => 'update', 'uses' => 'Admin\RolesController@updateRole',
          'permission' => 'edit-roles',
        ]);
      });
    });

    Route::prefix('users')->name('users.')->group(static function () {
      Route::get('/', [
        'as' => 'index', 'uses' => 'Admin\UsersController@index',
        'permission' => 'list-customers',
      ]);

      Route::get('trashed', [
        'as' => 'trashed', 'uses' => 'Admin\UsersController@trashedIndex',
        'permission' => 'list-deleted-customers',
      ]);

      Route::prefix('create')->group(static function () {
        Route::get('', [
          'as' => 'create', 'uses' => 'Admin\UsersController@createUser',
          'permission' => 'create-customers',
        ]);

        Route::post('', [
          'as' => 'store', 'uses' => 'Admin\UsersController@storeUser',
          'permission' => 'create-customers',
        ]);
      });

      Route::prefix('{user}')->group(static function () {
        Route::get('view', [
          'as' => 'view', 'uses' => 'Admin\UsersController@viewUser',
          'permission' => 'view-customers',
        ]);

        Route::get('edit', [
          'as' => 'edit', 'uses' => 'Admin\UsersController@editUser',
          'permission' => 'edit-customers',
        ]);

        Route::post('edit', [
          'as' => 'update', 'uses' => 'Admin\UsersController@updateUser',
          'permission' => 'edit-customers',
        ]);

        Route::get('delete', [
          'as' => 'delete', 'uses' => 'Admin\UsersController@deleteUser',
          'permission' => 'delete-customers',
        ]);

        Route::get('restore', [
          'as' => 'restore', 'uses' => 'Admin\UsersController@restoreUser',
          'permission' => 'restore-customers',
        ]);

        Route::prefix('addresses')->name('addresses.')->group(static function () {
          Route::prefix('{user_address}')->group(static function () {
            Route::get('delete', [
              'as' => 'delete',
              'uses' => 'Admin\UsersController@deleteUserAddress',
              'permission' => 'delete-addresses-customers',
            ]);
          });
        });

        Route::prefix('credi-cards')->name('creditCards.')->group(static function () {
          Route::prefix('{user_credit_card}')->group(static function () {
            Route::get('delete', [
              'as' => 'delete',
              'uses' => 'Admin\UsersController@deleteUserCreditCard',
              'permission' => 'delete-creditCards-customers',
            ]);
          });
        });

        Route::prefix('ajax')->name('ajax.')->group(static function () {
          Route::get('load', [
            'as' => 'load',
            'uses' => 'Admin\UsersController@ajaxLoadUser',
          ]);
          Route::prefix('address')->name('addresses.')->group(static function () {
            Route::get('addresses', [
              'as' => 'list',
              'uses' => 'Admin\UsersController@ajaxLoadUserAddresses',
            ]);

            Route::post('create', [
              'as' => 'create',
              'uses' => 'Admin\USersController@ajaxCreateUserAddress',
            ]);
          });
        });
      });
    });

  });
});

