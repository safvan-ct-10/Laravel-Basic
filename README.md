
1 - INSTALLATION & CONFIG
-------------------------
	* Install composer 
	* Lravel install via composer - composer create-project laravel/laravel example-app
	* Setup env file
	* Setup DB and run migration : if have err add length for err occured field

2 - DB SEEDER & FACTORY
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
	* namespaces - Add controolers Path like ['namespaces' => 'App\Http\Controllers']

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
	* Datatable - composer require yajra/laravel-datatables-oracle
    * https://www.itsolutionstuff.com/post/laravel-9-yajra-datatables-example-tutorialexample.html

8 - CREATE / UPDATE
----------
	* create, firstOrCreate, updateOrCreate
	* encrypt, decrypt id
	* request->all(), except(), only()
	* Custome Request - php artisan make:request StorePostRequest
	* Validation - 

9 - DELETE
----------
	* use SoftDeletes trait in model - For activate soft delete for model

10 - DEBUG BAR
--------------
    * composer require barryvdh/laravel-debugbar --dev
        - https://github.com/barryvdh/laravel-debugbar
    * Only use for development

11 - CACHE
----------
    * Basic cache - cache()->put(key, value, seconds);
        - $users = cache()->get('key');
        - cache()->forget('key');
    * Set cache drivers in config/cache.php
    * model cache package - https://github.com/GeneaLabs/laravel-model-caching
        - composer require genealabs/laravel-model-caching
        - php artisan modelCache:publish --config
        - not use in authorization model
    * redis - https://www.honeybadger.io/blog/laravel-caching-redis/

12 - MAIL
---------
    * php artisan make:mail UserCreatedMail
    * test mail - https://www.mailspons.com/app/inboxes/5342/messages/14521140
    * config mail at env
    * attach file - $this->view('emails.user-created')->attach('Path'); On mailable class

13 - ARTISAN COMMANDS
---------------------
	* php artisan make:command name
    * Path - app/console/commands
    * Methods - argument, ask, secret, confirm, anticipate, info, error, 

14 - TASK SCHEDULING (CRON JOB)
--------------------
    * Path - app/console/kernel.php schedule()
    * php artisan schedule:list
    * run - php artisan schedule:work
    * https://laravel.com/docs/9.x/scheduling

15 - EVENTS
-----------
	* php artisan make:event UserCreateEvent
    * Path - App\Events
    * Call event actions through listeners
    * php artisan make:listener UserCreateListener --event=UserCreateEvent
    * Path - App\Listeners
    * Write event action on - UserCreateListener handle()
        - Call event in controller : UserCreateEvent::dispatch($data);
        - Access data on event - UserCreateEvent construct()
        - Make return true on - App\Providers\EventServiceProvider shouldDiscoverEvents() or add in $listen
        - Add in $listen then create automatic event, listener
            + UserCreateEvent::class => [ UserCreateListener::class, UserUpdateListener::class, ], add event and listenrs like this to $listener
            + Use their Path like - use App\Events\UserCreateEvent;, use App\Listeners\UserCreateListener;
            + Run - php artisan event:generate

16 - BROADCASTING
-----------------
    * Live notifications / messages
    * User providers pusher, firebase etc..
    * Opensource alternative - https://github.com/beyondcode/laravel-websockets
    * create pusher account - https://dashboard.pusher.com/
    * Setup pusher credentials on env
    * change BROADCAST_DRIVER on env - BROADCAST_DRIVER=pusher
    * Setup pusher frontend and backend - https://dashboard.pusher.com/apps/1416665/getting_started
    * For laravel - composer require pusher/pusher-php-server
    * Event implement ShouldBroadcast
    * Change PrivateChannel to Channel on - Event broadcastOn()
    * Create broadcastAs() on Event and return event short name for call this event on frontend

17 - OBSERVERS
---------------
    * Trigger an function when model has create, update, delete
    * php artisan make:observe UserObserver --model=User
    * Path App\Observer
    * Register at App\Provider\EventServiceProvider.php on boot()
    * https://laravel.com/docs/9.x/eloquent#observers

18 - JOB & QUEUE
--------------
    * QUEUE_CONNECTION=
    * Generate migration - php artisan queue:table
    * php artisan migrate
    * php artisan make:job SendUserEmailJob
    * Path App\Jobs
    * Call job in controller
    * Run php artisan queue:listen
    * https://www.itsolutionstuff.com/post/laravel-8-queue-step-by-step-tutorial-exampleexample.html

19 - STUBS, COLLECTION AND HELPERS
----------------------------------
    * php artisan stub:publish
    * Path root folder stubs
    * Customize artisan make commands
    * https://laravel.com/docs/9.x/artisan#stub-customization

    * https://laravel.com/docs/9.x/collections

    * https://laravel.com/docs/9.x/helpers
    * Path App/Helpers.php
    * Create custom helper function on helpers.php

20 - API AND SANCTUM
--------------------
    * php artisan make:controller ApiController --api
    * Path routes api
    * api routes not allowed session and csrf
