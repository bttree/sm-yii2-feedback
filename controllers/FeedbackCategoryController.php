<?php

namespace bttree\smyfeedback\controllers;

use Yii;
use bttree\smyfeedback\models\FeedbackCategory;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use bttree\smyfeedback\models\FeedbackCategorySearch;
use yii\helpers\ArrayHelper;


/**
 * FeedbackCategoryController implements the CRUD actions for FeedbackCategory model.
 */
class FeedbackCategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'update',
                            'delete',
                        ],
                        'allow'   => true,
                        'roles'   => ['smyfeedback.edit'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow'   => true,
                        'roles'   => ['smyfeedback.view'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FeedbackCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $arrayParents = array_merge([Yii::t('smy.feedback', 'No parent')], ArrayHelper::map(FeedbackCategory::find()->all(), 'id', 'name'));

        return $this->render('index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'arrayParents' => $arrayParents,
            ]);
    }

    /**
     * Creates a new FeedbackCategory model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FeedbackCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create',
                                 [
                                     'model' => $model,
                                 ]);
        }
    }

    /**
     * Updates an existing FeedbackCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update',
                                 [
                                     'model' => $model,
                                 ]);
        }
    }

    /**
     * Deletes an existing FeedbackCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FeedbackCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeedbackCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FeedbackCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}