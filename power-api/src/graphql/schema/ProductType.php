<?php

namespace phuongpt\powerapi\graphql\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use phuongpt\powerapi\models\Product;

class ProductType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'ProductQuery',
            'fields' => function() {
                return [
                    'price' => [
                        'type' => Type::string(),
                    ],
                    'currency' => [
                        'type' => Type::string(),
                    ],
//                    'createDate' => [
//                        'type' => Type::string(),
//                        'description' => 'Date when product was created',
//                        'args' => [
//                            'format' => Type::string(),
//                        ],
//                        'resolve' => function(Product $product, $args) {
//                            if (isset($args['format'])) {
//                                return date($args['format'], strtotime($product->createDate));
//                            }
//                            return $product->createDate;
//                        },
//                    ],
                    'dateUpdated' => [
                        'type' => Type::string(),
                    ],
                    'uid' => [
                        'type' => Type::string(),
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }

}