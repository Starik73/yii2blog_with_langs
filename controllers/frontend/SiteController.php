<?php

namespace app\controllers\frontend;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\forms\ContactForm;
use app\models\forms\SignupForm;
use app\entities\enum\UserTypes;

class SiteController extends Controller
{
    /**
     * layout
     *
     * @var string
     */
    public $layout = 'frontend/main';

    /**
     * user_role
     *
     * @var string
     */
    public $user_role = UserTypes::USER;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->user_role = !Yii::$app->user->isGuest
            ? Yii::$app->user->identity->role
            : UserTypes::USER;
    }

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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view'  => '@app/views/frontend/site/pages/error.php'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

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
        return $this->render('pages/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', "Success logout.");

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('pages/contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('pages/about');
    }

    /**
     * Register new User.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('pages/signup', [
            'model' => $model,
        ]);
    }
}
