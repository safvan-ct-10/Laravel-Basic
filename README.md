
1 - INSTALLATION & CONFIG
-------------------------
	* Install composer 
	* Lravel install via composer
	* Setup env file
	* Setup DB and run migration : if have err add length for err occured field

2 - DB SEEDER $ FACTORY
-----------------------
	* add factory for data - php make:factory UserFactory
	* call factory in DatabaseSeeder class run() 
	* use HasFactory trait in model - For activate factory for model
	* https://github.com/fzaninotto/Faker/

3 - ROUTE
---------
	* middleware - Check route permissions or allowed for which users
		- php artisan make:middleware name
		- app\http\middleware
		- register middleware in kernal.php 
	* prevent browser page backword - Add below code for this 
		$response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')->header('Pragma','no-cache')->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT'); 
	* namespaces - Add controolers path like ['namespaces' => 'App\Http\Controllers']

4 - CONTROLLERS
---------------
	* Path - App\Http\Controllers
	* php artisan make:controller PhotoController --model=Photo --resource --requests
	* php artisan make:controller PhotoController --api

5 - MODELS - (CONFIG AT USER MODEL)
----------
	* Path - App\Models
	* php artisan make:model User
		-c : Controller
		-s : Seeder
		-f : Factory
		-R : Request
		-a : All of above

6 - VIEWS
---------
	* Path : Resources\Views

7 - READ
--------
	* https://codebeautify.org/jsonviewer
	* Accessor - change data while fetching 
	* Carbon - For date formates and date time functions https://carbon.nesbot.com/docs/
	* Global and Local scopes - https://laravel.com/docs/9.x/eloquent#global-scopes
		- GLOBAL SCOPE - WHERE CALL USER MODEL IT RETURN RESULTS WITH CHECKING GLOBAL SCOPES CONDITIONS
	* DYNAMIC SCOPE - For check dynamic value as scope
	* Pagination -  For enable bootstrap style call Paginator::useBootstrap();
		- AppServiceProvider -> boot() -> Paginator::useBootstrap();
	* Datatable -

8 - CREATE / UPDATE
----------
	* create, firstOrCreate, updateOrCreate
	* Custome Request - php artisan make:request StorePostRequest
	* Validation
	* encrypt, decrypt id
	* request->all(), except(), only()

9 - DELETE
----------
	* use SoftDeletes trait in model - For activate soft delete for model

10 - DEBUG BAR
--------------
    * composer require barryvdh/laravel-debugbar --dev
        - https://github.com/barryvdh/laravel-debugbar
    * Only use for development



