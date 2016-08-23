#Laravel Bugherd

[![Build Status](https://travis-ci.org/onwwward/laravel-bugherd.svg?branch=master)](https://travis-ci.org/onwwward/laravel-bugherd)
[![StyleCI](https://styleci.io/repos/66357568/shield)](https://styleci.io/repos/65727693)
[![license](https://img.shields.io/github/license/onwwward/laravel-bugherd.svg?maxAge=2592000)]()
[![Packagist](https://img.shields.io/packagist/v/onwwward/laravel-bugherd.svg?maxAge=2592000)]()

This is a Laravel 5 wrapper for the [PHP Bugherd Api](https://github.com/beleneglorion/php-bugherd-api) package.

##What is Bugherd?
[BugHerd](https://bugherd.com/about/) is a simple point and click bug tracker, that was founded in 2011 by Alan Downie and Matt Milosavljevic.

https://bugherd.com/

https://www.bugherd.com/api_v2


##Basic Installation

###Laravel

Add the service provider to the providers array in ```config/app.php```:

```php
...
Onwwward\Bugherd\BugherdServiceProvider::class,
...
```

You can optionally use the facade for shorter code.
Add the facade to the alias array in ```config/app.php```:
```php
...
'Bugherd' => Onwwward\Bugherd\Facade\Bugherd::class,
...
```

###Lumen
Find the section in   ```bootstrap/app.php``` where you should register the service providers and add the following:

```php
...
$app->register(Onwwward\Bugherd\BugherdServiceProvider::class);
...
```

You can optionally use the facade for shorter code. However you will have to uncomment the following line in ```bootstrap/app.php``` file:
```php
...
$app->withFacades();
...
```
You will also have to add the following to the same file:
```php
...
class_alias('Onwwward\Bugherd\Facades\Bugherd', 'Bugherd');
...
```

## Configuration

###Laravel

You'll need to provide your `apikey` which you can find under your profile settings in [Bugherd](https://bugherd.com). In [Laravel](https://laravel.com) you should be able to publish the configuration file with an `artisan` command, but you can create the file manually as well.

```bash
$ php artisan vendor:publish --provider="Onwwward\Bugherd\BugherdServiceProvider" --tag="config"
```

> **Where's the file?** Laravel 5 will publish the config file to `/config/bugherd.php`.


###Lumen

There is no command for publishing package files in [Lumen](https://lumen.laravel.com) so you'll have to create the config file manually. Create a `config` directory in the application's root in case you don't have it. Then, either copy the `bugherd.php` file from `/vendor/onwwward/laravel-bugherd/src/config/` or create the php file returning a simple array with the correct 'apikey' .

```php
...
return [
  'apikey' => 'YOUR_API_KEY'
];
...
```


##Code Example

There are several ways to resolve something out of the container. 

###with Facade 

Include the facade at the top:

```php
use Onwwward/Bugherd/Facades/Bugherd;
```

Then you can use it anywhere:

```php
Bugherd::api('user')->all();
```

### Type Hinting

```php
protected $protected;

public function __construct(Bugherd/Client $bugherd)
{
   $this->bugherd = $bugherd;
}
```

### Make method (Laravel)

```php
$bugherd = $this->app->make('bugherd');
$bugherd->api('user')->all();
```

### app Helper (Lumen)
```php
$bugherd = app('bugherd');
$bugherd->api('user')->all();
```

## Accessing the Bugherd Resources

```php
/** Projects **/
// Get all projects
$projects = Bugherd::api('project')->all();

// Get all active projects
$active_projects = $bugherd->api('project')->allActive();

// Get all projects with name/id pairs
$projects = $bugherd->api('project')->listing($forceUpdate, $reverse);

// Get all active projects with name/id pairs
$active_projects = $bugherd->api('project')->listingActive($forceUpdate, $reverse);

// Get project id given its name
$id = $bugherd->api('project')->getIdByName($name);

// Get a project
$project = $bugherd->api('project')->show($id);

// Create a project
$project = $bugherd->api('project')->create(array(
    'name'      => 'Name of the Project',
    'devurl'    => 'http://example.com/',
    'is_active' => true,
    'is_public' => false,
));

/** Users **/
// Get all users
$users = $bugherd->api('user')->all();

// Get all guests
$guests = $bugherd->api('user')->getGuests();

// Get all members
$members = $bugherd->api('user')->getMembers();

/ Tasks **/
// Get a task
$task = $bugherd->api('task')->show($projectId, $taskId);

// Create a task
$task = $bugherd->api('task')->create($projectId, array(
    'description'      => 'Some description',
    'requester_id'     => $requester_id,
    'requester_email'  => $requester_email
));

// Update a task
$task = $bugherd->api('task')->update($projectId, $taskId, array(
    'description'      => 'Some new description',
));

// Get all tasks
$tasks = $bugherd->api('task')->all($projectId, array(
    'status' => 'backlog',
    'priority' => 'critical'
));

/** Organization **/
// Get organization information
$organization = $bugherd->api('organization')->show();

/** Comments **/
// Create a comment
$comment = $bugherd->api('comment')->create($projectId, $taskId, array(
    'text'      => 'some comment',
    'user_id'     => $user_id,
    'user_email'  => $user_email
));

// Get all comments
$comments = $bugherd->api('comment')->all($projectId, $taskId);


/** Webhooks **/
// Get all webhooks
$webhooks = $bugherd->api('webhook')->all();

// Create a webhook
$webhook = $bugherd->api('webhook')->create(array(
    'target_url' => 'http://example.com/tasks/create',
    'event' => 'task_create' // this could be task_update, task_destroy, comment
));

// Delete a webhook
$bugherd->api('webhook')->remove($webhookId);
```

            
###Todo
- Add logging maybe?


###License
This plugin is released under the permissive MIT license. Your contributions are always welcome.
