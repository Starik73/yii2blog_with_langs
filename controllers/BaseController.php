<?php
/**
 * Astashenkov
**/

namespace app\controllers;

use app\entities\enum\Languages;
use Yii;
use yii\web\Controller;
use app\entities\enum\UserTypes;
use yii\web\Request;

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
        parent::__construct($id, $module, $config);
        // Set user_role
        $this->user_role = !Yii::$app->user->isGuest
            ? Yii::$app->user->identity->role
            : UserTypes::USER;

        // Set language
        $exist = false;
        if (!empty($lang_code = (new Request())->get('sl')) && $lang_code != Languages::RU) {
            $languages = Languages::getAllLanguages();
            if (in_array($lang_code, $languages)) {
                $exist = true;
            }
        }
        $this->lang_code = $exist ? $lang_code : Languages::RU;
        defined('DESC_LANG') or define ('DESC_LANG', $this->lang_code);
    }
}
