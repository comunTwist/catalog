<?php

namespace app\controllers;

use app\models\Category;
use app\models\Goods;
use Yii;
use app\models\LangGoods;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LangGoodsController implements the CRUD actions for LangGoods model.
 */
class LangGoodsController extends Controller
{

    /**
     * Lists all LangGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LangGoods::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LangGoods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LangGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($goods_id)
    {
        $model = new LangGoods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $language = Yii::$app->language;
        $main_model = new Goods();
        $goods = $main_model->getAllGoods();
        $goods_map = ArrayHelper::map($goods, 'id', 'slug');
        $model->goods_id = $goods_id;

        return $this->render('create', compact('model', 'goods_map', 'language'));
    }

    /**
     * Updates an existing LangGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $language = $model->lang;
        $main_model = new Goods();
        $goods = $main_model->getAllGoods();
        $goods_map = ArrayHelper::map($goods, 'id', 'slug');

        return $this->render('update', compact('model', 'goods_map', 'language'));
    }

    /**
     * Deletes an existing LangGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LangGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LangGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LangGoods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
