<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "approver".
 *
 * @property int $id
 * @property int|null $reviewer_id เอกสาร
 * @property int|null $approve_name ผู้อนุมัติ
 * @property string|null $approve_at วันที่อนุมัติ
 * @property string|null $approve_comment ความคิดเห็น
 * @property int|null $approved อนุมัติ
 *
 * @property Reviewer $reviewer
 * @property User $approveName
 */
class Approver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reviewer_id', 'approve_name', 'approved'], 'integer'],
            [['approve_comment'], 'string'],
            [['approve_at'], 'string', 'max' => 45],
            [['reviewer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reviewer::className(), 'targetAttribute' => ['reviewer_id' => 'id']],
            [['approve_name'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['approve_name' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reviewer_id' => Yii::t('app', 'เอกสาร'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_at' => Yii::t('app', 'วันที่อนุมัติ'),
            'approve_comment' => Yii::t('app', 'ความคิดเห็น'),
            'approved' => Yii::t('app', 'อนุมัติ'),
        ];
    }

    /**
     * Gets query for [[Reviewer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewer()
    {
        return $this->hasOne(Reviewer::className(), ['id' => 'reviewer_id']);
    }

    /**
     * Gets query for [[ApproveName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApproveName()
    {
        return $this->hasOne(User::className(), ['id' => 'approve_name']);
    }
}
