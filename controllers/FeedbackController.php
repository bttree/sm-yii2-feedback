<?php

namespace bttree\smyfeedback\controllers;

use Yii;
use bttree\smyfeedback\models\Feedback;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use bttree\smyfeedback\models\FeedbackSearch;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
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
                    [
                        'actions' => ['send-feedback'],
                        'allow'   => true,
                        'roles'   => ['?', '@'],
                    ]
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
     * @return array|Response
     * @throws NotFoundHttpException
     */
    public function actionSendFeedback()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $post = Yii::$app->request->post();

        $model = new Feedback();
        $model->load($post);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if (!empty($post['OtherFields'])) {
                foreach ($post['OtherFields'] as $label => $value) {
                    $model->text .= "<br> <p>$label: $value</p>";
                }
            }
        }

        if ($model->save()) {
            $message = Yii::t('smy.feedback', 'Message sent successfully!');
            if ($request->isAjax) {
                return [
                    'result'  => true,
                    'message' => $message
                ];
            } else {
                Yii::$app->getSession()->setFlash('success', $message);

                return $this->redirect($request->referrer);
            }
        } else {
            $message = Yii::t('smy.feedback', 'Error sending message!');
            if ($request->isAjax) {
                return [
                    'result'  => false,
                    'message' => $message
                ];
            } else {
                Yii::$app->getSession()->setFlash('error', $message);

                return $this->redirect($request->referrer);
            }
        }
    }

    /**
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',
                             [
                                 'dataProvider' => $dataProvider,
                                 'searchModel' => $searchModel,
                             ]);
    }

    /**
     * Creates a new Feedback model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feedback();

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
     * Updates an existing Feedback model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost && Yii::$app->request->post('send_mail')){
            $model->setScenario('sendMail');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->post('send_mail')){
                $this->sendMail($model);
            }
            return $this->redirect(['index']);
        } else {

            return $this->render('update', ['model' => $model]);

        }
    }

    /**
     * Deletes an existing Feedback model.
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
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    private function sendMail($model)
    {
        Yii::$app->mailer->compose()
            ->setFrom($this->module->email_origin)
            ->setTo($model->email)
            ->setSubject($model->theme)
            ->setTextBody($model->answer)
            ->send();
    }
}
