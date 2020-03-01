<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Marks;

/**
 * MarksSearch represents the model behind the search form of `app\models\Marks`.
 */
class MarksSearch extends Marks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mark', 'date', 'student_id', 'subject_id', 'teacher_id'], 'integer'],
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
    public function search($params, $group_id = false, $subject_id=false, $teacher_id=false)
    {
        $query = Marks::find();
        if ($group_id && $subject_id && $teacher_id){
            $query>where(['group_id' => $group_id, 'subject_id' => $subject_id, 'teacher_id' => $teacher_id]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'mark' => $this->mark,
            'date' => $this->date,
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
        ]);

        return $dataProvider;
    }
}
