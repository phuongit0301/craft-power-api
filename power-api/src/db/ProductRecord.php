<?php


namespace phuongpt\powerapi\db;


use craft\db\ActiveRecord;

class ProductRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }
}