<?php

class container
{
    protected $bindings = [];
    function bind($name, callable $resolver)
    {
        $this->bindings[$name] = $resolver;
    }

    function make($name)
    {
        return $this->bindings[$name]();
    }
}



class Fish
{
    public function swim()
    {
        return "Swimming";
    }

    public function eat()
    {
        return "Eating";
    }
}

class Bike
{
    public function start()
    {
        return "starting";
    }
}

app()->bind('fish', function () {
    return new Fish();
});

app()->bind('bike', function () {
    return new bike();
});

// dd(app()->make('fish')->eat());

class Facade
{
    public static function __callStatic($method, $args)
    {
        $instance = app()->make(static::getFacadeAccessor());

        if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }

    protected static function getFacadeAccessor() {}
}


class BikeFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'bike';
    }
}

class FishFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fish';
    }
}


$container = new container;

$container->bind('fish', function () {
    return new Fish();
});

// dd($container->make('fish')->swim());


// dd(app()->make('bike')->start());
dd(FishFacade::swim());
