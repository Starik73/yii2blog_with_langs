<?php
/**
 * Astashenkov
**/

namespace app\controllers;

use app\entities\enum\Languages;
use Yii;
use yii\web\Controller;
use app\entities\enum\UserTypes;
use app\entities\helpers\LangCode;

class BaseController extends Controller
{
    /**
     * user_role
     *
     * @var string
     */
    public $user_role = UserTypes::USER;

    /**
     * lang_code
     *
     * @var string
     */
    public $lang_code = Languages::RU;

    public function __construct($id, $module, $config = [])
    {
        defined ('TIME') or define ('TIME', time());
        parent::__construct($id, $module, $config);
        // Set user_role
        $this->user_role = !Yii::$app->user->isGuest
            ? Yii::$app->user->identity->role
            : UserTypes::USER;

        // Set language
        LangCode::setLangCode();
    }
}
