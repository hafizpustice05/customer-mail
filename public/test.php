<?php


interface Language
{

    public function getLanguage(): string;
}

class Grammer
{

    function __construct(public Language $language) {}

    function getClassName(): string
    {
        return $this->language->getLanguage();
    }

    function of($class): mixed
    {
        return (new $class())->getLanguage();
    }
}

class Bangla implements Language
{
    public function getLanguage(): string
    {
        return 'Bangla-----------';
    }
}

class English implements Language
{
    public function getLanguage(): string
    {
        return 'English-----------';
    }
}

$grammer = new Grammer(new English());

// (Bangla::class);

// dd($grammer->of(Bangla::class));
// dd($grammer->getClassName());


class Cat
{
    public function eat(): string
    {
        return 'fish';
    }
}

class Dog
{
    public function eat(): string
    {
        return 'beef';
    }
}
class MyFacade
{
    protected static function getFacadeAccessor()
    {
        return 'Classname'; // the IoC binding.
    }
}
