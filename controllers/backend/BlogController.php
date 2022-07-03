<?php

namespace app\controllers\backend;

use app\entities\enum\UserTypes;
use app\models\Blog;
use app\models\BlogsDetails;
use app\models\BlogSearch;
use app\models\UploadImage;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends BackendController
{
    /**
     * Lists all Blog models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if ($this->user_role == UserTypes::ADMIN || $this->user_role == UserTypes::AUTHOR) {
            $model = new Blog();
            $image_model = new UploadImage();
            $details_model = new BlogsDetails();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    $image_model->image = UploadedFile::getInstance($image_model, 'image');
                    if (!empty($image_model->image)) {
                        $details_model->img_url = $image_model->upload($model->id) ?? 'no_image';
                    }
                    $details_model->blog_id = $model->id;
                    if ($details_model->load($this->request->post()) && $details_model->save()) {
                        Yii::$app->session->setFlash('success', "New blog id:{$model->id} created");
                        return $this->redirect(['view', 'id' => $details_model->blog_id]);
                    }
                }
            } else {
                $model->loadDefaultValues();
                $details_model->loadDefaultValues();
            }

            return $this->render('create', [
                'model'         => $model,
                'details_model' => $details_model,
                'image_model'   => $image_model
            ]);
        } else {
            Yii::$app->session->setFlash('warning', 'Not admin or author');
            return $this->redirect(['index']);
        }

    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if ($this->user_role == UserTypes::ADMIN || $this->user_role == UserTypes::AUTHOR) {
            $model = $this->findModel($id);
            $image_model = new UploadImage();
            $details_model = BlogsDetails::findOne(['blog_id' => $id]);

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    $image_model->image = UploadedFile::getInstance($image_model, 'image');
                    if (!empty($image_model->image)) {
                        $img_url = $image_model->upload($model->id);
                    }
                    if ($details_model->load($this->request->post())) {
                        $details_model->img_url = !empty($img_url) ? $img_url : 'no_image';
                        if ($details_model->save()) {
                            Yii::$app->session->setFlash('success', "Blog id:{$model->id} updated");
                            return $this->redirect(['view', 'id' => $details_model->blog_id]);
                        }
                    }
                }
            } else {
                $model->loadDefaultValues();
                $details_model->loadDefaultValues();
            }

            return $this->render('update', [
                'model'         => $model,
                'details_model' => $details_model,
                'image_model'   => $image_model
            ]);
        } else {
            Yii::$app->session->setFlash('warning', 'Not admin or author');
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
