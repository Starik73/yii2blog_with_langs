<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $details_model app\models\BlogsDetails */

$this->title = 'Create Blog';
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">
    <?= $this->render('_form', [
        'model'         => $model,
        'details_model' => $details_model,
        'image_model'   => $image_model,
    ]) ?>
</div>
