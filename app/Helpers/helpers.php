<?php

use App\Models\User;
use App\Models\Admin;
use App\Interfaces\AdminMenu;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


if (!function_exists('admin_can')) {
    /**
     * Check if admin has permission
     *
     * @param  string  $permission
     *
     * @return bool
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function admin_can(string $permission)
    {
        try {
            return \admin()->hasPermissionTo($permission)
                   || \admin()->hasRole('super-admin');
        } catch (Exception $exception) {
            return false;
        }
    }
}

if (!function_exists('get_seven_days')) {
    /**
     * Create a 7 days array starting from today
     *
     * @param $days
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function get_seven_days($days = 0)
    {
        $Today = Carbon::now()->subDays($days);
        $Days  = [];
        for ($i = 0; $i < 7; $i++) {
            $Days[] = $Today->addDays($i)->clone();
        }

        return $Days;
    }
}

if (!function_exists('generate_hours')) {
    /**
     * Generate array of hours from 00 to 23
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function generate_hours(): array
    {
        $hours = [];
        for ($i = 0; $i <= 23; $i++) {
            $hour    = str_pad($i, 2, '0', STR_PAD_LEFT);
            $hours[] = sprintf('%s:00', $hour);
            $hours[] = sprintf('%s:15', $hour);
            $hours[] = sprintf('%s:30', $hour);
        }

        return $hours;
    }
}

if (!function_exists('user')) {
    /**
     * Get currently logged in user
     *
     * @return \App\Models\User|null
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function user(): ?User
    {
        return Auth::guard('user')->user();
    }
}


if (!function_exists('getLoggedUserLocale')) {
    /**
     * Return the locale of the current logged in user
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function getLoggedUserLocale()
    {
        /**
         * @var $loggedUser User|null
         */
        $loggedUser = null;
        if (auth('api-user')->user()) {
            $loggedUser = auth('api-user')->user();
        }

        return $loggedUser !== null ? $loggedUser->locale : 'en';
    }
}

if (!function_exists('admin')) {
    /**
     * return current logged in admin
     *
     * @return Admin|Authenticatable
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function admin()
    {
        return auth('admin')->user();
    }
}

if (!function_exists('discover_permissions')) {
    /**
     * Discover all permissions from controller menus and Routes
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function discover_permissions($group = true)
    {
        $permissions = [];

        $ControllerMenus = build_admin_menu();

        foreach ($ControllerMenus as $controllerMenu) {
            if (is_array($controllerMenu)
                && isset($controllerMenu['permission'])) {
                $permissions[$controllerMenu['permission']] =
                  $controllerMenu['permission'];
            }
        }

        /**
         * @var $routeCollection Route[]
         */
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $route) {
            if (isset($route->action['permission'])) {
                $permissions[$route->action['permission']] =
                  $route->action['permission'];
            }
        }

        if (!$group) {
            return $permissions;
        }

        $finalPermissions = [];

        foreach ($permissions as $permission) {
            $permissionAr                        = explode('-', $permission);
            $key                                 =
              $permissionAr[count($permissionAr) - 1];
            $finalPermissions[$key][$permission] = $permission;
        }

        return $finalPermissions;
    }
}

if (!function_exists('build_admin_menu')) {
    /**
     * Build Admin Side Menu from Admin Controllers
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function build_admin_menu()
    {
        $Menu = [];
        foreach (get_controllers() as $controller) {
            if (class_implements($controller['name'], AdminMenu::class)) {
                $menu   = $controller['name']::getMenu();
                $Menu[] = $menu;
            }
        }
        usort($Menu, static function ($a, $b) {
            return $a[0]['order'] > $b[0]['order'];
        });
        $finalMenu = [
            /*[
              'search'     => true,
              'href'       => '#',  //form action
              'method'     => 'get', //form method
              'input_name' => 'menu-search-input', //input name
              'text'       => 'Search', //input placeholder
            ],
            [
              'text'   => 'search',
              'search' => true,
              'topnav' => true,
            ],*/
          ['header' => 'Administrative Menu'],
        ];
        foreach ($Menu as $key => $menu) {
            foreach ($menu as $k => $m) {
                $finalMenu[] = $m;
            }
        }

        return $finalMenu;
    }
}

if (!function_exists('get_controllers')) {
    /**
     * Return array of all admin controllers class names
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    function get_controllers()
    {
        $Controllers = [];
        foreach (glob(base_path().'/app/Http/Controllers/Admin/*.php') as $file)
        {
            $path          = $file;
            $file          = explode('/', $file);
            $file          = explode('.', $file[count($file) - 1]);
            $Controllers[] = [
              'path' => $path,
              'name' => '\\App\\Http\\Controllers\\Admin\\'.$file[0],
            ];
        }

        return $Controllers;
    }
}
