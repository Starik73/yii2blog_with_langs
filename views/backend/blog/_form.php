<?php

use app\entities\enum\ObjectStatuses;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $details_model app\models\BlogsDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin([
                'method' => 'post',
                'options' => ['class' => 'row']
        ]); ?>
                <div class="hidden">
            <?= $form->field($model, 'author_id')->textInput(['readonly' => true]) ?>
        </div>
        <div class="hidden">
            <?= $form->field($model, 'created_at')->textInput([
                'readonly' => true,
                'value' => $model->isNewRecord
                    ? time()
                    : $model->created_at
                ])
            ?>
        </div>
        <div class="hidden">
            <?= $form->field($model, 'updated_at')->textInput([
                'readonly' => true,
                'value' => $model->isNewRecord
                    ? time()
                    : $model->updated_at
                ])
            ?>
        </div>
        <div class="w-100"></div>
        <div class="col-5">
            <?= $form->field($details_model, 'title')->textInput() ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'status')->dropDownList(
                ObjectStatuses::getSimpleStatusesList()
            ) ?>
        </div>
        <div class="w-100"></div>
        <div class="col-6">
            <?= $form->field($details_model, 'body')->textArea() ?>
        </div>
        <div class="col-3">
            <?= $form->field($details_model, 'img_url')->textInput([[
                'readonly' => true,
                'value' => $details_model->isNewRecord
                    ? '--'
                    : $details_model->img_url
            ]]) ?>
            <img class="img-fluid" src="https://picsum.photos/400" alt="picsum">
        </div>
        <div class="col-3">
            <?= $form->field($details_model, 'lang_code')->textInput([
                'readonly' => true,
                'value' => $details_model->isNewRecord
                    ? (defined('DESC_LANG') ? DESC_LANG : SITE_LANG)
                    : $details_model->lang_code
            ]) ?>
        </div>
        <div class="col-2 form-group mx-left">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
