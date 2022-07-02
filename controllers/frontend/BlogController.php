<?php
/**
 * Astashenkov
**/

namespace app\controllers\frontend;

use yii\web\Controller;

class BlogController extends FrontendController
{
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
