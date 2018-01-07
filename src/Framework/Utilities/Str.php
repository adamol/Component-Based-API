<?php

namespace App\Framework\Utilities;

class Str
{
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public static function shortName($object)
    {
        return new self((new \ReflectionClass($object))->getShortName());
    }

    public function replace($search, $replace)
    {
        $this->string = str_replace($search, $replace, $this->string);

        return $this;
    }

    public function prepend($prepend)
    {
        $this->string = $prepend.$this->string;

        return $this;
    }

    public function toLower()
    {
        $this->string = strtolower($this->string);

        return $this;
    }

    public function toString()
    {
        return $this->string;
    }
}