<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GroupTeachers;

/**
 * GroupTeachersSearch represents the model behind the search form of `app\models\GroupTeachers`.
 */
class GroupTeachersSearch extends GroupTeachers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['group_id', 'teacher_id'], 'safe'],
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
        $query = GroupTeachers::find()->where($condition)->andWhere(['not', ['teacher_id' => 5]]);

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
        $query->joinWith('group');
        $query->joinWith('teacher');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'groups.name', $this->group_id])
            ->andFilterWhere(['like', 'CONCAT_WS(" ", teacher.last_name, teacher.first_name, teacher.middle_name)', $this->teacher_id]);

        return $dataProvider;
    }
}
