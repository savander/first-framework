# Simple SavFramework - For learning
It is very simple framework (actually, it's not a real framework, don't work yet.)
Based o ***MVC Pattern***, it means that we have Model, View and Controller.
We have very simple configuration system which use DotNotation to take data from configs.

## Configuration System
Configuration System provides you few simple methods to manage your configurations.
First at all, we can use Config everywhere by using ***$config*** variable.
To bring data from configuration you need first to load them.

We need to add path's to our configs. You can store them everywhere you want.
```php
$config->addPaths(
  [
    realpath(ROOT_DIR . '<dir>'),
  ]
)
```

After that, you can load your configurations by using ***load()*** method.

```php
$config->load('filename')
$config->load('filename2')
```

Supported config files extensions:
 * PHP (return array())
 * INI
 * JSON
 
To get data, simply you use ***$config->get()*** method, where you need to use ***DotNotation system***.
```php
$config->get('path.to.key');
```
Which means:
```php
array(
  path => [ 
        to => [
            key => value
          ]
      ]
  )
```
 Very simple!
 
## Routing
 At this moment, we have very simple routing, which allows to use ***GET*** and ***POST*** send methods.
 You can use very simple controllers and anonymous functions inside route.
 
 For example, to add new Route you need to use ***$route*** global variable.
 ```php
 $route->get('/url/', 'controller@method')
 ```
 or
 ```php
 $route->post('/url/, function() {
    // Code
 });
 ```


