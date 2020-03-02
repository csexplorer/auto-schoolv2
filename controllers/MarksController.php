<?php

namespace app\controllers;

use Yii;
use app\models\Marks;
use app\models\MarksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarksController implements the CRUD actions for Marks model.
 */
class MarksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Marks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MarksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Marks model.
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

    public function actionGetId()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            $model = Marks::findOne($data['id']);
            if ($model) {
                return 'bor';
            } else {
                return 'yangi';
            }
        }
        return 'notAjax';
    }
    /**
     * Creates a new Marks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Marks();
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionMarkCreate()
    {
        Yii::$app->formatter->locale='uz-UZ';
        if (Yii::$app->request->isAjax) {
            $mark = new Marks();
            $user = Yii::$app->user;
            $data = Yii::$app->request->post();
            $mark->teacher_id = $user->getId();
            $mark->subject_id = $data['subjectId'];
            $mark->student_id = $data['studentId'];
            $mark->date = Yii::$app->formatter->asTimestamp($data['date']);
            $mark->group_id = $data['groupId'];
            $mark->mark = $data['mark'];

            if ($mark->save()) {
                return 'saqlandi';
            } else {
                return 'xatolik';
            }
        }
        return 'notAjax';
    }

    /**
     * Updates an existing Marks model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionEdit()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model = $this->findModel($data['id']);
            $model->mark=$data['mark'];
            if (!empty($data['mark'])) {
                if ($model->save()) {
                    return "success";
                } else {
                    return 'failed';
                }
            } else {
                $model->delete();
                return 'deleted';
            }
        }
        return 'notAjax';
    }

    /**
     * Deletes an existing Marks model.
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
     * Finds the Marks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Marks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
