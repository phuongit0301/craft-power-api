<?php
namespace phuongpt\powerapi\controllers;

use craft\web\Controller;
// use craft\controllers\GraphqlController;
use yii\web\Response;

use phuongpt\powerapi\graphql\controllers\GraphqlController;

class IndexController extends GraphqlController
{
    protected $allowAnonymous = ['index'];
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
    	// $site = \Craft::$app->getRequest()->getParam('site');

	    // if (\Craft::$app->sites->getSiteByHandle($site)) {
	    //   \Craft::$app->sites->setCurrentSite($site);
	    // }
	    return parent::actionIndex();
//	    return $this->renderTemplate('powerapi/graphql', ['result' => $result]);
        // return $this->asJson(['success' => true]);
    }
}