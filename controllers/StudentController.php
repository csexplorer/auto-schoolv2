<?php

namespace app\controllers;

use app\models\Attendance;
use app\models\GroupSubjects;
use app\models\Marks;
use Yii;
use app\models\Student;
use app\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['mark', 'view-from-teacher', 'edit', 'attendance']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['groups.status' => 1]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList($group_id)
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['group_id' => $group_id, 'status' => 1]);
        return $this->render('group_students', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMark($group_id, $subject_id)
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['student.group_id' => $group_id, 'groups.status' => 1]);
//        $groupAndSubject = GroupSubjects::find()->where(['group_id' => $group_id, 'subject_id' => $subject_id])->one();
        $marks = Marks::find()->where(['group_id' => $group_id, 'subject_id' => $subject_id])->all();

        return $this->render('marks', [
            'dataProvider' => $dataProvider,
//            'groupAndSubject' => $groupAndSubject,
            'subject_id' => $subject_id,
            'group_id' => $group_id,
            'marks' => $marks
        ]);
    }

    public function actionAttendance($group_id, $subject_id)
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['student.group_id' => $group_id, 'groups.status' => 1]);
//        $groupAndSubject = GroupSubjects::find()->where(['group_id' => $group_id, 'subject_id' => $subject_id])->one();
        $attendance = Attendance::find()->where(['group_id' => $group_id, 'subject_id' => $subject_id])->all();

        return $this->render('attendance', [
            'dataProvider' => $dataProvider,
//            'groupAndSubject' => $groupAndSubject,
            'subject_id' => $subject_id,
            'group_id'=> $group_id,
            'attendance' => $attendance
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewFromTeacher($id, $subject_id)
    {
        $mark = new Marks();
        $user = Yii::$app->user;
        if ($mark->load(Yii::$app->request->post())) {
            $mark->teacher_id = $user->getId();
            $mark->subject_id = $subject_id;
            $mark->student_id = $id;
            $mark->date = strtotime($mark->date);
            $mark->group_id = $this->findModel($id)->group_id;

            $mark->save();
            return $this->refresh();
        }

        return $this->render('view-from-teacher', [
            'model' => $this->findModel($id),
            'mark' => $mark
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
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
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
