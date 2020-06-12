<?php

namespace phuongpt\powerapi\graphql\controllers;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use GraphQL\Server\StandardServer;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use GraphQL\Error\Debug;
use craft\web\Controller;

use phuongpt\powerapi\graphql\schema\Types;

class GraphqlController extends Controller
{
    public $modelClass = '';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['POST', 'OPTIONS'],
            'main' => ['GET']
        ];
    }

    public function actions()
    {
        return [];
    }

    public function actionIndex()
    {
        $query = \Yii::$app->request->get('query', \Yii::$app->request->post('query'));
        $variables = \Yii::$app->request->get('variables', \Yii::$app->request->post('variables'));
        $operation = \Yii::$app->request->get('operation', \Yii::$app->request->post('operation', null));

        if (empty($query)) {
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variables = isset($input['variables']) ? $input['variables'] : [];
            $operation = isset($input['operation']) ? $input['operation'] : null;
        }

        if (!empty($variables) && !is_array($variables)) {
            try {
                $variables = Json::decode($variables);
            } catch (InvalidParamException $e) {
                $variables = null;
            }
        }

        $schema = new Schema([
            'query' => Types::query(),
//            'mutation' => Types::mutation(),
        ]);

        try {
            $result = GraphQL::executeQuery(
                $schema,
                $query,
                null,
                null,
                empty($variables) ? null : $variables,
                empty($operation) ? null : $operation
            );
            $output = $result->toArray();
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($output);
    }
}