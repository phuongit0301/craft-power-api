<?php

namespace phuongpt\powerapi\graphql\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use app\models\Product;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'product' => [
                        'type' => Types::productMutation(),
                        'args' => [
                            'id' => Type::nonNull(Type::int()),
                        ],
                        'resolve' => function($root, $args) {
                            return Product::find()->where($args)->one();
                        },
                    ],
                    // 'address' => [
                    //     'type' => Types::addressMutation(),
                    //     'args' => [
                    //         'id' => Type::nonNull(Type::int()),
                    //     ],
                    //     'resolve' => function($root, $args) {
                    //         return Address::find()->where($args)->one();
                    //     },
                    // ],
                ];
            }
        ];

        parent::__construct($config);
    }
}