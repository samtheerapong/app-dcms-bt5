<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property int $id
 * @property string|null $type_name ประเภทการร้องขอ
 * @property string|null $type_details รายละเอียด
 * @property string|null $color สี
 *
 * @property Requester[] $requesters
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_details'], 'string'],
            [['type_name'], 'string', 'max' => 100],
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
            'type_name' => Yii::t('app', 'ประเภทการร้องขอ'),
            'type_details' => Yii::t('app', 'รายละเอียด'),
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
        return $this->hasMany(Requester::class, ['types_id' => 'id']);
    }
}
