<?php
namespace phuongpt\powerapi\models;

use craft\base\Model;

class Product extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }
}