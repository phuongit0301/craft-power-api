<?php
namespace phuongpt\powerapi\behaviors;

use Craft;
use yii\base\Behavior;

use phuongpt\powerapi\elements\Product;
use phuongpt\powerapi\elements\db\ProductQuery;

class ProductBehavior extends Behavior
{
    public function products($criteria = null): ProductQuery
    {
        $query = Product::find();
        if($criteria) {
            Craft::configure($query, $criteria);
        }
        return $query;
    }
}