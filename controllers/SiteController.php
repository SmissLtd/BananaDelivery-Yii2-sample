<?php

namespace app\controllers;

use Yii;
use app\models\PackSize;
use app\helpers\DeliveryHelper;

class SiteController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'calculate' => ['post']
                ]
            ],
            'ajax' => [
                'class' => \yii\filters\AjaxFilter::className(),
                'only' => ['calculate']
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'sizes' => PackSize::find()->orderBy(['size' => SORT_ASC])->all()
        ]);
    }
    
    public function actionCalculate()
    {
        $count = max(1, intval(Yii::$app->request->post('count', 1)));
        $sizes = PackSize::find()->orderBy(['size' => SORT_DESC])->all();
        $packs = DeliveryHelper::buildPacks($count, $sizes);
        return $this->renderPartial('result', ['packs' => $packs]);
    }
}