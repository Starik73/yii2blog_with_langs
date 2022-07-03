<?php

use app\entities\enum\ObjectStatuses;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model         app\models\Blog */
/* @var $details_model app\models\BlogsDetails */
/* @var $image_model   app\models\BlogsDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin([
                'method'  => 'post',
                'options' => [
                    'class'   => 'row',
                    'enctype' => 'multipart/form-data'
                ]
        ]); ?>
        <div class="hidden">
            <?= $form->field($model, 'author_id')->textInput([
                'readonly' => true,
                'value' => $model->isNewRecord
                    ? Yii::$app->user->identity->id
                    : $model->author_id
            ]);
            ?>
            <?= $form->field($model, 'created_at')->textInput([
                'readonly' => true,
                'value' => $model->isNewRecord
                    ? TIME
                    : $model->created_at
            ]);
            ?>
            <?= $form->field($model, 'updated_at')->textInput([
                'readonly' => true,
                'value' => TIME
            ]);
            ?>
        </div>
        <div class="w-100"></div>
        <div class="col-6">
            <?= $form->field($details_model, 'title')->textInput() ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'status')->dropDownList(
                ObjectStatuses::getSimpleStatusesList()
            ) ?>
        </div>
        <div class="col-1">
            <?= $form->field($details_model, 'lang_code')->textInput([
                'readonly' => true,
                'value' => $details_model->isNewRecord
                    ? (defined('DESC_LANG') ? DESC_LANG : SITE_LANG)
                    : $details_model->lang_code
            ]) ?>
        </div>
        <div class="w-100"></div>
        <div class="col-9">
        <?= $form->field($details_model, 'body')->widget(CKEditor::class,[
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false,  //по умолчанию false
            ],
        ]); ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'img_url')->textInput([[
                'readonly' => true,
                'value' => $model->isNewRecord
                    ? '--'
                    : $model->img_url
            ]]) ?>
            <div class="card">
                <?php
                    if (!$details_model->isNewRecord) {
                        echo Html::img(Yii::$app->urlManager->createUrl($model->img_url));
                    }
                ?>
                <?= $form->field($image_model, 'image')->fileInput() ?>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-2 form-group mx-left">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
