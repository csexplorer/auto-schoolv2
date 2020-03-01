<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubjectTeachers;

/**
 * SubjectTeachersSearch represents the model behind the search form of `app\models\SubjectTeachers`.
 */
class SubjectTeachersSearch extends SubjectTeachers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['subject_id', 'teacher_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SubjectTeachers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->where(['not', ['teacher_id' => 5]]),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('teacher');
        $query->joinWith('subject');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'CONCAT_WS(" ", teacher.last_name, teacher.first_name, teacher.middle_name)', $this->teacher_id])
            ->andFilterWhere(['like', 'subject.name', $this->subject_id]);

        return $dataProvider;
    }
}
