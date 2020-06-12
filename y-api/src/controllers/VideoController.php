<?php
namespace phuongpt\yapi\controllers;

use craft\web\Controller;
use yii\web\Response;
use craft\elements\Entry;


class VideoController extends Controller
{
    public function actionIndex()
    {
    	$entries = Entry::find()->section('youtubeApi')->with(['related'])->all();
    	return $this->asJson(['success' => true, 'entries' => $entries]);
    }
}