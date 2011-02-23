<?php
/**
 *
 *
 */

namespace pere\struct;

/**
 * Basic struct class with optional value validation when the __set method gets
 * overwritten in the child classes.
 *
 */
abstract class base
{

    public function __get($property)
    {
        throw new RuntimeException('Trying to get non-existing property ' . $property);
    }

    public function __set($property, $value)
    {
        throw new RuntimeException('Trying to set non-existing property ' . $property);
    }

    public function __clone()
    {
        foreach ($this as $property => $value) {
            if (is_object($value)) {
                $this->$property = clone $value;
            }
        }
    }

    public static function __set_state(array $properties)
    {
        $struct = new static();
        foreach ($properties as $property => $value) {
            $this->$property = $value;
        } return $struct;
    }

}