<?php

namespace phuongpt\powerapi\graphql\schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use phuongpt\powerapi\models\Product;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => function() {
                return [
                    'getProducts' => [
                        'type' => Type::listOf(Types::product()),

                        // добавим сюда аргументов, дабы
                        // выбрать необходимого нам юзера
//                        'args' => [
//                            // чтобы агрумент сделать обязательным
//                            // применим модификатор Type::nonNull()
//                            'id' => Type::nonNull(Type::int()),
//                        ],
                        'resolve' => function($root, $args) {
                            return Product::find()->all();
                        }
                    ],
                    'getProductById' => [
                        'type' => Types::product(),
                        'args' => [
                            'id' => Type::nonNull(Type::int())
                        ],
                        'resolve' => function($root, $args) {
                            return Product::find()->where(['id' => $args['id']])->one();
                        }
                    ]

//                    // в принципе на поле user можно остановиться, в случае
//                    // если нам нужно обращаться к данным лиш конкретного пользователя
//                    // но если нам нужны данные с другими привязками добавим
//                    // для примера еще полей
//
//                    'addresses' => [
//                        // без дополтинельных параметров
//                        // просто вернет нам списох всех
//                        // адресов
//                        'type' => Type::listOf(Types::address()),
//
//                        // добавим фильтров для интереса
//                        'args' => [
//                            'zip' => Type::string(),
//                            'street' => Type::string(),
//                        ],
//                        'resolve' => function($root, $args) {
//                            $query = Address::find();
//
//                            if (!empty($args)) {
//                                $query->where($args);
//                            }
//
//                            return $query->all();
//                        }
//                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}