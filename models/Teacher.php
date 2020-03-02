<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $address
 * @property string $phone_number
 * @property string $photo
 * @property string $speciality
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attendance[] $attendances
 * @property GroupTeachers[] $groupTeachers
 * @property Marks[] $marks
 * @property SubjectTeachers[] $subjectTeachers
 */
class Teacher extends \yii\db\ActiveRecord
{
    public $secretKey = 'WHATEVER_SECRET';
    public $password;
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address', 'phone_number', 'speciality', 'created_at', 'password'], 'required'],
            [['status', 'created_at', 'updated_at', 'role_group'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'address', 'phone_number', 'photo', 'speciality'], 'string', 'max' => 255],
            [['password_hash', 'password_reset_token', 'auth_key'], 'string', 'max' => 512],
            ['phone_number', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This phone number has already been taken.'],
            ['password', 'string', 'min' => 6],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg']
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
            'speciality' => 'Mutaxasisligi',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'role_group' => 'Role Group',
            'password' => 'Parol',
            'imageFile' => 'Avatar'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::className(), ['teacher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupTeachers()
    {
        return $this->hasMany(GroupTeachers::className(), ['teacher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Marks::className(), ['teacher_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectTeachers()
    {
        return $this->hasMany(SubjectTeachers::className(), ['teacher_id' => 'id']);
    }

    protected function getFullName() {
        return $this->last_name . " " . $this->first_name . " " . $this->middle_name;
    }

    protected function getPass()
    {
        return Yii::$app->security->decryptByPassword(utf8_decode($this->password_hash), $this->secretKey);
    }
}
