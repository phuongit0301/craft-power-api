<?php
namespace phuongpt\powerapi;

use Craft;
use yii\base\Behavior;

use phuongpt\powerapi\elements\db\ProductQuery;

class CraftVariableBehavior extends Behavior
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