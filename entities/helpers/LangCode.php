<?php
/**
 * Astashenkov
**/

namespace app\entities\helpers;

use app\entities\enum\Languages;
use Yii;
use yii\web\Request;

/**
 * LangCode
 */
class LangCode
{
    /**
     * setLangCode
     *
     * @return void
     */
    public static function setLangCode():void
    {
        $session = &Yii::$app->session;
        $lang_code = $session->get('lang_code');
        if (!empty($lang_code)
            && empty((new Request())->get('sl'))
        ) {
            defined('DESC_LANG') or define ('DESC_LANG', $lang_code);
        } else {
            $exist = false;
            if (!empty($lang_code = (new Request())->get('sl')) && $lang_code != Languages::RU) {
                $languages = Languages::getAllLanguages();
                if (in_array($lang_code, $languages)) {
                    $exist = true;
                }
            }
            $lang_code = !empty($exist)
                ? $lang_code
                : Languages::RU;
            $session->set('lang_code', $lang_code);
            defined('DESC_LANG') or define ('DESC_LANG', $lang_code);
        }
    }
}