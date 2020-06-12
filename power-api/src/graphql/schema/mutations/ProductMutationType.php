<?php

namespace phuongpt\powerapi\graphql\schema\mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use phuongpt\powerapi\models\Product;
use phuongpt\powerapi\graphql\schema\Types;

class ProductMutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    // для теста реализуем здесь
                    // один метод для изменения данных
                    // объекта User
                    'update' => [
                        // какой должен быть возвращаемый тип
                        // здесь 2 варианта - либо
                        // булев - удача / неудача
                        // либо же сам объект типа User.
                        // позже мы поговорим о валидации
                        // тогда всё станет яснее, а пока
                        // оставим булев для простоты
                        
                        // 'type' => Type::boolean(),

                        // с валидацией
                        'type' => Types::validationErrorsUnionType(Types::product()),
                        
                        'description' => 'Update product data.',
                        'args' => [
                            // сюда засунем все то, что
                            // разрешаем изменять у User.
                            // в примере оставим все поля необязательными
                            'price' => Type::string(),
                            'currency' => Type::string(),
                            'uid' => Type::string(),
                        ],
                        'resolve' => function(Product $product, $args) {
                            // ну а здесь всё проще простого,
                            // т.к. библиотека уже все проверила за нас:
                            // есть ли у нас юзер, правильные ли у нас
                            // аргументы и всё ли пришло, что необходимо
                            $product->setAttributes($args);
                            
                            if ($product->save()) {
                                return $product;
                            } else {
                                // на практике, этот весь код что ниже -
                                // переиспользуемый, и должен быть вынесен
                                // в отдельную библиотеку
                                foreach ($product->getErrors() as $field => $messages) {
                                    $errors[] = [
                                        'field' => $field,
                                        'messages' => $messages,
                                    ];
                                }

                                // возвращаемый формат ассоциативного
                                // массива должен соответствовать
                                // полям типа (в нашем случае ValidationErrorsListType)
                                return ['errors' => $errors]; 
                            }
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }

}