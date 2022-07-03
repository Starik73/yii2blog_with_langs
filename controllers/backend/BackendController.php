<?php
/**
 * Astashenkov
**/

namespace app\controllers\backend;

use app\controllers\BaseController;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * BackendController
 */
class BackendController extends BaseController
{
    /**
     * layout
     *
     * @var string
     */
    public $layout = 'backend/admin';

        /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'update', 'create', 'delete', 'view', 'logout'],
                    'rules' => [
                        [
                            'actions' => ['index', 'update', 'create', 'delete', 'view', 'logout'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }
}
