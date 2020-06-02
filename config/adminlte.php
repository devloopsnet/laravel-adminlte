<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Title
	|--------------------------------------------------------------------------
	|
	| Here you can change the default title of your admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
	|
	*/

	'title'         => 'DevloopsAdminLTE!',
	'title_prefix'  => '',
	'title_postfix' => '',

	/*
	|--------------------------------------------------------------------------
	| Logo
	|--------------------------------------------------------------------------
	|
	| Here you can change the logo of your admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#62-logo
	|
	*/

	'logo'              => strpos( $_SERVER['REQUEST_URI'] ?? '', 'login' ) !== false ? '<img src="http://devloops.net/img/logo.png" width="200" alt="DevloopsAdminLTE!"/>' : 'DevloopsAdminLTE!',
	'logo_img'          => 'http://devloops.net/img/logo.png',
	'logo_img_class'    => 'brand-image-xl',
	'logo_img_xl'       => null,
	'logo_img_xl_class' => 'brand-image-xs',
	'logo_img_alt'      => 'DevloopsAdminLTE',

	/*
	|--------------------------------------------------------------------------
	| Layout
	|--------------------------------------------------------------------------
	|
	| Here we change the layout of your admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#63-layout
	|
	*/

	'layout_topnav'        => null,
	'layout_boxed'         => null,
	'layout_fixed_sidebar' => null,
	'layout_fixed_navbar'  => null,
	'layout_fixed_footer'  => null,

	/*
	|--------------------------------------------------------------------------
	| Extra Classes
	|--------------------------------------------------------------------------
	|
	| Here you can change the look and behavior of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#64-classes
	|
	*/

	'classes_body'             => '',
	'classes_brand'            => '',
	'classes_brand_text'       => '',
	'classes_content_header'   => 'container-fluid',
	'classes_content'          => 'container-fluid',
	'classes_sidebar'          => 'sidebar-dark-primary elevation-4',
	'classes_sidebar_nav'      => '',
	'classes_topnav'           => 'navbar-white navbar-light',
	'classes_topnav_nav'       => 'navbar-expand-md',
	'classes_topnav_container' => 'container',

	/*
	|--------------------------------------------------------------------------
	| Sidebar
	|--------------------------------------------------------------------------
	|
	| Here we can modify the sidebar of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#65-sidebar
	|
	*/

	'sidebar_mini'                            => true,
	'sidebar_collapse'                        => true,
	'sidebar_collapse_auto_size'              => true,
	'sidebar_collapse_remember'               => true,
	'sidebar_collapse_remember_no_transition' => true,
	'sidebar_scrollbar_theme'                 => 'os-theme-light',
	'sidebar_scrollbar_auto_hide'             => 'l',
	'sidebar_nav_accordion'                   => true,
	'sidebar_nav_animation_speed'             => 300,

	/*
	|--------------------------------------------------------------------------
	| Control Sidebar (Right Sidebar)
	|--------------------------------------------------------------------------
	|
	| Here we can modify the right sidebar aka control sidebar of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#66-control-sidebar-right-sidebar
	|
	*/

	'right_sidebar'                     => false,
	'right_sidebar_icon'                => 'fas fa-cogs',
	'right_sidebar_theme'               => 'red',
	'right_sidebar_slide'               => true,
	'right_sidebar_push'                => true,
	'right_sidebar_scrollbar_theme'     => 'os-theme-light',
	'right_sidebar_scrollbar_auto_hide' => 'l',

	/*
	|--------------------------------------------------------------------------
	| URLs
	|--------------------------------------------------------------------------
	|
	| Here we can modify the url settings of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#67-urls
	|
	*/

	'use_route_url' => false,

	'dashboard_url' => 'admin/dashboard',

	'logout_url' => 'admin/logout',

	'login_url' => 'admin/login',

	'register_url' => false,

	'password_reset_url' => false,

	'password_email_url' => false,

	/*
	|--------------------------------------------------------------------------
	| Laravel Mix
	|--------------------------------------------------------------------------
	|
	| Here we can enable the Laravel Mix option for the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#68-laravel-mix
	|
	*/

	'enabled_laravel_mix' => false,

	/*
	|--------------------------------------------------------------------------
	| Menu Items
	|--------------------------------------------------------------------------
	|
	| Here we can modify the sidebar/top navigation of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#69-menu
	|
	*/

	'menu' => build_admin_menu(),

	/*
	|--------------------------------------------------------------------------
	| Menu Filters
	|--------------------------------------------------------------------------
	|
	| Here we can modify the menu filters of the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#610-menu-filters
	|
	*/

	'filters' => [
		JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
		JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
		\App\Helpers\AdminMenuFilter::class
	],

	/*
	|--------------------------------------------------------------------------
	| Plugins Initialization
	|--------------------------------------------------------------------------
	|
	| Here we can modify the plugins used inside the admin panel.
	|
	| For more detailed instructions you can look here:
	| https://github.com/jeroennoten/Laravel-AdminLTE/#611-plugins
	|
	*/

	'plugins' => [
		[
			'name'   => 'Datatables',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.js',
				],
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
				],
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
				],
				[
					'type'     => 'css',
					'asset'    => false,
					'location' => '//cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
				],
				[
					'type'     => 'css',
					'asset'    => false,
					'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
				],
			],
		],
		[
			'name'   => 'Select2',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
				],
				[
					'type'     => 'css',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
				],
			],
		],
		[
			'name'   => 'Chartjs',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
				],
			],
		],
		[
			'name'   => 'Sweetalert2',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
				],
			],
		],
		[
			'name'   => 'Pace',
			'active' => true,
			'files'  => [
				[
					'type'     => 'css',
					'asset'    => true,
					//'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
					'location' => 'css/pace-red.css',
				],
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
				],
			],
		],
		[
			'name'   => 'priceFormat',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => true,
					'location' => 'js/jquery.priceformat.min.js'
				]
			]
		],
		[
			'name'   => 'Bootstrap-4-DateTimePicker',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js'
				],
				[
					'type'     => 'js',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js'
				],
				[
					'type'     => 'css',
					'asset'    => false,
					'location' => '//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css'
				]
			]
		],
		[
			'name'   => 'DevloopsAdminLTE',
			'active' => true,
			'files'  => [
				[
					'type'     => 'js',
					'asset'    => true,
					'location' => 'js/tools.js'
				]
			]
		]
	],
];
