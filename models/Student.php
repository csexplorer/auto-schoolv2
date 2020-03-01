<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $address
 * @property string $phone_number
 * @property string $photo
 * @property int $start_date
 * @property int $payment
 * @property int $group_id
 *
 * @property Attendance[] $attendances
 * @property Marks[] $marks
 * @property Groups $group
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address', 'phone_number', 'start_date', 'group_id'], 'required'],
            [['start_date', 'payment', 'group_id'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'address', 'phone_number', 'photo'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Ism',
            'last_name' => 'Familiya',
            'middle_name' => 'Otasining ismi',
            'address' => "Tug'ilgan joy",
            'phone_number' => 'Telefon raqam',
            'photo' => 'Rasm',
            'start_date' => 'Boshlagan sana',
            'payment' => "To'lov",
            'group_id' => 'Guruhi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::className(), ['student_id' => 'id']);
    }

    protected function getFullName() {
        return $this->last_name . " " . $this->first_name . " " . $this->middle_name;
    }

    protected function getTotalMarks() {
        $marks = array_column($this->marks, 'mark');
        return array_sum($marks);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Marks::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }
}
