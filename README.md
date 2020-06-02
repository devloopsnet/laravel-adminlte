# laravel-adminlte

A boilerplate AdminLTE for Laravel which includes, Admins, Roles, Users, Notifications, Generate Admin Menu from Controllers, Auto-Descover Permissions from routes and menus. 

# Installation
- clone this repo
- `composer install`
- `php artisan devloops:create-role`
- `php artisan devloops:create-admin "System Admin" "admin@example.com" "{Password}"`

Now you can naviagate to admin/login and use the credintials you've choosen above.

# Defining permissions for route

```
Route::get('example',[
  'as'=>'example',
  'uses'=>'Admin\ExampleController@index',
  //---Exatra Key--//
  'permission'=>'can-view-example'  
  //---Exatra Key--//
]);
```

# Admin Menu

```
use App\Interfaces\AdminMenu;
use App\Http\Controllers\Controller;

class ExampleController extends Controller implements AdminMenu{

public static function getMenu(): array {
		return [
			[
				'text'       => 'EXAMPLE',
				'order'      => 3,
				'icon'       => 'fa fa-user-shield',
				'permission' => 'manage-administrators',
				'submenu'    => [
					[
						'text'       => 'Example Home',
						'route'      => 'admin.example.index',
						'icon'       => 'fa fa-user-shield',
            //---Exatra Key--//
						'permission' => 'can-view-example',
            //---Exatra Key--//
					],
				]
			],
		];
	}
  
}
```

# Requests (AdminBaseRequest)

By using BaseAdminRequest it'll automatically authorize the request based on the permission key provided in the route definition.

```
use App\Http\Requests\BaseAdminRequest;

class ExampleRequest extends BaseAdminRequest {

  public function rules():array{}

}

public function example(ExampleRequest $request){
  // can access the following
  // $request->getAdmin(): Admin
  // $request->faild(): boolean
  // $request->errors(): MessageBag
}
```
