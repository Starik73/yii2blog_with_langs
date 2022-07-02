<?php

namespace app\controllers\frontend;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class BlogController extends Controller
{
    /**
     * layout
     *
     * @var string
     */
    public $layout = 'frontend/main';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionPost()
    {
        return $this->render('post');
    }
}
