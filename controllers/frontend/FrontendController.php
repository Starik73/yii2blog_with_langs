<?php
/**
 * Astashenkov
**/

namespace app\controllers\frontend;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use app\models\forms\SignupForm;
use app\entities\enum\UserTypes;

class FrontendController extends Controller
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
}
