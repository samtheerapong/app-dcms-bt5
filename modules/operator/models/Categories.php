<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $category_code ระดับเอกสาร(CODE)
 * @property string|null $category_details รายละเอียด
 * @property string|null $color สี
 *
 * @property Requester[] $requesters
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_code'], 'required'],
            [['category_code', 'color'], 'string', 'max' => 45],
            [['category_details'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_code' => Yii::t('app', 'ระดับเอกสาร(CODE)'),
            'category_details' => Yii::t('app', 'รายละเอียด'),
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
        return $this->hasMany(Requester::className(), ['categories_id' => 'id']);
    }
}
