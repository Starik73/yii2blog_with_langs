<?php

use app\entities\enum\ObjectStatuses;
use app\models\Blog;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <p>
        <?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-hover table-light'
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            'alias',
            [
                'attribute'=>'author_id',
                'contentOptions' =>['class' => 'table_class'],
                'content'=>function($data){
                    $user = User::findIdentity($data->author_id);
                    return "ID: {$data->author_id}, name: {$user->username}";
                }
            ],
            [
                'attribute'=>'status',
                'contentOptions' =>['class' => 'table_class'],
                'content'=>function($data){
                    $statuses = ObjectStatuses::getSimpleStatusesList();
                    return (string) $statuses[$data->status];
                }
            ],
            [
                'attribute'=>'created_at',
                'contentOptions' =>['class' => 'table_class'],
                'content'=>function($data){
                    return date('d.m.Y', $data->created_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'contentOptions' =>['class' => 'table_class'],
                'content'=>function($data){
                    return date('d.m.Y', $data->updated_at);
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Blog $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
