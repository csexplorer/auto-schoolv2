<?php

namespace app\controllers;

use Yii;
use app\models\Attendance;
use app\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
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
     * Lists all Attendance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetId()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            $model = Attendance::findOne($data['id']);
            if ($model) {
                return 'bor';
            } else {
                return 'yangi';
            }
        }
        return 'notAjax';
    }

    public function actionEdit()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model = $this->findModel($data['id']);
            if (!empty($data['status'])) {
                $model->status=$data['status'];
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

    public function actionAttendanceCreate()
    {
        Yii::$app->formatter->locale='uz-UZ';
        if (Yii::$app->request->isAjax) {
            $attendance = new Attendance();
            $user = Yii::$app->user;
            $data = Yii::$app->request->post();
            $attendance->teacher_id = $user->getId();
            $attendance->subject_id = $data['subjectId'];
            $attendance->student_id = $data['studentId'];
            $attendance->date = Yii::$app->formatter->asTimestamp($data['date']);
            $attendance->group_id = $data['groupId'];
            $attendance->status = $data['status'];

            if ($attendance->save()) {
                return 'saqlandi';
            } else {
                return 'xatolik';
            }
        }
        return 'notAjax';
    }

    /**
     * Displays a single Attendance model.
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
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Attendance model.
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

    /**
     * Deletes an existing Attendance model.
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
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
