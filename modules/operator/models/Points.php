<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "points".
 *
 * @property int $id
 * @property string|null $point_code รหัส
 * @property string|null $point_name จุดรับเอกสาร
 * @property int|null $sub_points อยู่ภายใต้
 *
 * @property Reviewer[] $reviewers
 */
class Points extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'points';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_points'], 'integer'],
            [['point_code'], 'string', 'max' => 45],
            [['point_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'point_code' => Yii::t('app', 'รหัส'),
            'point_name' => Yii::t('app', 'จุดรับเอกสาร'),
            'sub_points' => Yii::t('app', 'อยู่ภายใต้'),
        ];
    }

    /**
     * Gets query for [[Reviewers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewers()
    {
        return $this->hasMany(Reviewer::className(), ['points_id' => 'id']);
    }
}
