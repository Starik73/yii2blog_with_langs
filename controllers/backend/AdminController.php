<?php

namespace app\controllers\backend;

use app\entities\enum\UserTypes;
use app\models\forms\LoginForm;
use Yii;

/**
 * AdminController
 */
class AdminController extends BackendController
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('warning', "Already in system.");
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $role = $this->user_role;
            $user_name = Yii::$app->user->identity->username;
            if ($role == UserTypes::ADMIN) {
                $text = "Hello, administrator {$user_name}";
            } elseif ($role == UserTypes::AUTHOR) {
                $text = "Hello, author {$user_name}";
            } else {
                $text = "Hello, user {$user_name}";
            }
            Yii::$app->session->setFlash('success', $text);
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}