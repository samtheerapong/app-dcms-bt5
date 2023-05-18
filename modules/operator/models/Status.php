<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string|null $status_name สถานะ
 * @property string|null $status_details รายละเอียด
 * @property string|null $color สี
 *
 * @property Requester[] $requesters
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_details'], 'string'],
            [['status_name'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_name' => Yii::t('app', 'สถานะ'),
            'status_details' => Yii::t('app', 'รายละเอียด'),
            'color' => Yii::t('app', 'สี'),
        ];
    }

    /**
     * Gets query for [[Requesters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequesters()
    {
        return $this->hasMany(Requester::className(), ['status_id' => 'id']);
    }
}
