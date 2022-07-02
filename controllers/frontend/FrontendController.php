<?php
/**
 * Astashenkov
**/

namespace app\controllers\frontend;

use app\controllers\BaseController;
use app\entities\enum\Languages;
use Yii;
use app\entities\enum\UserTypes;
use yii\web\Request;

class FrontendController extends BaseController
{
    /**
     * layout
     *
     * @var string
     */
    public $layout = 'frontend/main';
}
