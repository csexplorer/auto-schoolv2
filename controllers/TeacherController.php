<?php

namespace app\controllers;

use app\models\Groups;
use app\models\Subject;
use app\models\SubjectTeachers;
use app\models\GroupTeachers;
use app\models\User;
use Yii;
use app\models\Teacher;
use app\models\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
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
                        'actions' => ['groups', 'subjects', 'profile', 'profile-edit']
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
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function checkGroupsForActiveness($v)
    {
        $groups = Groups::find()->all();
        $res = false;
        foreach ($groups as $elem)
        {
            if ($elem->id === $v->group_id && $elem->status === 1)
            {
                $res = true;
                break;
            }
        }
        return $res;
    }

    public function actionGroups()
    {
        $teacher_id = Yii::$app->user->getId();
        $teacher = Teacher::findOne($teacher_id);
        $teacher_groups = $teacher->groupTeachers;
        $activeTeacherGroups = array_filter($teacher_groups, array($this, "checkGroupsForActiveness"));

        return $this->render('teacher_groups', [
            'teacher_groups' => $activeTeacherGroups
        ]);
    }
    public function actionSubjects($group_id)
    {
        $teacher_id = Yii::$app->user->getId();
        $teacher = Teacher::findOne($teacher_id);
        $teacher_subjects = $teacher->subjectTeachers;
        $tcol = array_column($teacher_subjects, 'subject_id');
        $group_subjects = \app\models\GroupSubjects::find()->where(['group_id' => $group_id])->all();
        $gcol = array_column($group_subjects, 'subject_id');

        $diffs = array_intersect($gcol,$tcol);
        $teacher_group_subjects = [];
        foreach ($diffs as $diff) {
            $teacher_group_subjects[] = Subject::findOne($diff);
        }
        return $this->render('teacher_subjects',[
            'teacher_subjects' => $teacher_group_subjects,
            'group_id' => $group_id
        ]);
    }
    /**
     * Displays a single Teacher model.
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

    public function actionProfile() {
        $user = Yii::$app->user;
        $model = $this->findModel($user->getId());
        return $this->render('profile', [
            'user' => $user->identity,
            'model' => $model
        ]);
    }

    public function actionProfileEdit() {
        $user = Yii::$app->user;
        $userModel = $this->findUserModel($user->getId());
        $model = $this->findModel($user->getId());

        if ($model->load(Yii::$app->request->post())) {
            $userModel->imageFile = UploadedFile::getInstance($model, 'imageFile');

            $userModel->photo = $userModel->imageFile->name;
            $userModel->updated_at = strtotime(date('Y-m-d H:i:s'));
            $userModel->phone_number = $model->phone_number;
            $userModel->setPassword($model->password);
            if ($userModel->save() && $userModel->upload()) {
                return $this->refresh();
            };
        }

        return $this->render('profile', [
            'user' => $userModel,
            'model' => $model
        ]);
    }

    /**
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $teacher = new Teacher();
        $user = new User();

        if ($teacher->load(Yii::$app->request->post())) {
            $user->imageFile = UploadedFile::getInstance($teacher, 'imageFile');

            $user->first_name = $teacher->first_name;
            $user->last_name = $teacher->last_name;
            $user->middle_name = $teacher->middle_name;
            $user->address = $teacher->address;
            $user->phone_number = $teacher->phone_number;
            $user->speciality = $teacher->speciality;
            $user->photo = $user->imageFile->name;
            $user->created_at = strtotime(date('Y-m-d H:i:s'));
//            $user->role_group = $teacher->role_group || 2;
            $user->setPassword($teacher->password);
            $user->generateAuthKey();
            
            if ($user->save() && $user->upload()) {
                return $this->redirect(['view', 'id' => $user->id]);
            }
        }

        return $this->render('create', [
            'model' => $teacher,
        ]);
    }

    /**
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userModel = $this->findUserModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $userModel->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $avatar = !empty($userModel->imageFile) ?  $userModel->imageFile->name : '';

            $userModel->first_name = $model->first_name;
            $userModel->last_name = $model->last_name;
            $userModel->middle_name = $model->middle_name;
            $userModel->address = $model->address;
            $userModel->phone_number = $model->phone_number;
            $userModel->speciality = $model->speciality;
            $userModel->photo = $avatar;
            $userModel->updated_at = strtotime(date('Y-m-d H:i:s'));
            $userModel->setPassword($model->password);
            if ($userModel->save() && $userModel->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
            };
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Teacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $count1 = SubjectTeachers::find()->where(['teacher_id' => $id])->count();
        $count2 = GroupTeachers::find()->where(['teacher_id' => $id])->count();
        if ($count1 > 0 || $count2 > 0) {
            SubjectTeachers::deleteAll(['teacher_id' => $id]);
            GroupTeachers::deleteAll(['teacher_id' => $id]);
            $this->findModel($id)->delete();
        } else {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findUserModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
