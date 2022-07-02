<?php
/**
 * Astashenkov
**/

namespace app\controllers\backend;

use Yii;
use yii\web\Controller;
use app\entities\enum\UserTypes;

class BackendController extends Controller
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
