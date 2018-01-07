<?php

namespace App\Framework;

class Model
{
    protected $fillables = [];

    protected $attributes = [];

    public static function create($attributes)
    {
        $model = get_called_class();
        $object = new $model;

        foreach ($attributes as $attribute => $value) {
            if (! in_array($attribute, $object->fillables)) {
                continue;
            }

            $object->$attribute = $value;
        }

        return $object;
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function __get($key)
    {
        return $this->attributes[$key];
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}