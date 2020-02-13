<?php

namespace app\controllers;

use app\models\Category;
use app\models\Review;
use Yii;
use app\models\Goods;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends AppController
{
    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Goods::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModelWith($id);

        $model_review = new Review();
        $model_review->lang_goods_id = (isset($model->translate)) ? $model->translate->id : null;
        $dataProvider = new ActiveDataProvider([
            'query' => Review::find()->where([
                'lang_goods_id' => $model_review->lang_goods_id
            ]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
//        debug($dataProvider); die();
        return $this->render('view', compact('model', 'model_review', 'dataProvider'));
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && !empty($model->current_category) && $model->save()) {
            // Загружаем галерею
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            $model->uploadGallery();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $category_model = new Category();
        $categories = $category_model->getCategories();
        $categories_map = ArrayHelper::map($categories, 'id', 'slug');

        return $this->render('create', compact('model', 'categories_map'));
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModelWith($id);

        if ($model->load(Yii::$app->request->post()) && !empty($model->current_category) && $model->save()) {
            // Загружаем галерею
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            $model->uploadGallery();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->current_category = $model->category;
        $images = $model->getImages();
        $category_model = new Category();
        $categories = $category_model->getCategories();
        $categories_map = ArrayHelper::map($categories, 'id', 'slug');
        return $this->render('update', compact('model', 'categories_map', 'images'));
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->removeImages();
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelWith($id)
    {
        $model = Goods::find()
            ->with([
                'category',
//                'translate' => function ($q) {
//                    $q->with([
//                        'reviews'
//                    ]);
//                }
            ])
            ->where(['id' => $id])
            ->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
