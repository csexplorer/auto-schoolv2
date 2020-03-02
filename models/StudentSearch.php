<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;

/**
 * StudentSearch represents the model behind the search form of `app\models\Student`.
 */
class StudentSearch extends Student
{
    public $fullName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'start_date', 'payment'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'address', 'phone_number', 'photo', 'fullName', 'group_id'], 'safe'],
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
    public function search($params, $condition)
    {
        $query = Student::find()->with('marks');


        $dataProvider = new ActiveDataProvider([
            'query' => $query->where($condition),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('group');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'payment' => $this->payment,
        ]);
        $query->andFilterWhere(['like', 'CONCAT_WS(" ", last_name, first_name, middle_name)', $this->fullName])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'groups.name', $this->group_id])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
