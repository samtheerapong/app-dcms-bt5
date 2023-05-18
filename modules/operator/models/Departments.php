<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string|null $department_code รหัส
 * @property string|null $department_details รายละเอียด
 * @property string|null $color สี
 * @property int|null $user_id หัวหน้าแผนก
 *
 * @property User $user
 * @property Requester[] $requesters
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_details'], 'string'],
            [['user_id'], 'integer'],
            [['department_code', 'color'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'department_code' => Yii::t('app', 'รหัส'),
            'department_details' => Yii::t('app', 'รายละเอียด'),
            'color' => Yii::t('app', 'สี'),
            'user_id' => Yii::t('app', 'หัวหน้าแผนก'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Requesters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequesters()
    {
        return $this->hasMany(Requester::className(), ['departments_id' => 'id']);
    }
}
