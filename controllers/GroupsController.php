<?php

namespace app\controllers;

use app\models\GroupSubjects;
use app\models\GroupTeachers;
use app\models\Student;
use app\models\Teacher;
use Yii;
use app\models\Groups;
use app\models\GroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupsController implements the CRUD actions for Groups model.
 */
class GroupsController extends Controller
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

    public function actionList($category_id)
    {
        $group_list = Groups::find()->where(['category_id' => $category_id])->all();
        return $this->render('group_list', [
            'group_list' => $group_list
        ]);
    }

    /**
     * Lists all Groups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['status' => 1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArchived()
    {
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['status' => 0]);

        return $this->render('archived', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Groups model.
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
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Groups();
        $grTchModel = new GroupTeachers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $grTchModel->teacher_id = 5;
            $grTchModel->group_id = $model->id;
            if ($grTchModel->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            };
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Groups model.
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

    public function actionAddArchive() {

        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['id'];
            $model = $this->findModel($id);
            GroupSubjects::updateAll(['status' => 0], ['group_id' => $id]);
            GroupTeachers::updateAll(['status' => 0], ['group_id' => $id]);
            Student::updateAll(['status' => 0], ['group_id' => $id]);
            $model->status = 0;

            if ($model->save()) {
                return 'arxivlandi';
            } else {
                return 'xatolik';
            }
        }
    }

    public function actionRestoreArchive() {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['id'];
            $model = $this->findModel($id);
            GroupSubjects::updateAll(['status' => 1], ['group_id' => $id]);
            GroupTeachers::updateAll(['status' => 1], ['group_id' => $id]);
            Student::updateAll(['status' => 1], ['group_id' => $id]);
            $model->status = 1;

            if ($model->save()) {
                return 'tiklandi';
            } else {
                return 'xatolik';
            }
        }
    }

    /**
     * Deletes an existing Groups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $count1 = GroupSubjects::find()->where(['group_id' => $id])->count();
        $count2 = GroupTeachers::find()->where(['group_id' => $id])->count();
        if ($count1 > 0 || $count2 > 0) {
            GroupSubjects::deleteAll(['group_id' => $id]);
            GroupTeachers::deleteAll(['group_id' => $id]);
            $this->findModel($id)->delete();
        } else {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Groups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Groups::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
