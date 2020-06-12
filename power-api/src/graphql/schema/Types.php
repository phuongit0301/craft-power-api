<?php

namespace phuongpt\powerapi\graphql\schema;

use GraphQL\Type\Definition\ObjectType;

class Types
{
    private static $query;
    private static $mutation;

    private static $product;
    private static $address;
    private static $city;

    private $types = [];

    public function get($name)
    {
        if (!isset($this->types[$name])) {
            $this->types[$name] = $this->{$name}();
        }
        return $this->types[$name];
    }

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function product()
    {
        return self::$product ?: (self::$product = new ProductType());
    }

//    public static function address()
//    {
//        return self::$address ?: (self::$address = new AddressType());
//    }
//
//    public static function city()
//    {
//        return self::$city ?: (self::$city = new CityType());
//    }

}