<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "reviewer".
 *
 * @property int $id
 * @property int|null $requester_id เอกสารที่ร้องขอ
 * @property int|null $reviewer_name ทบทวนโดย
 * @property string|null $reviewer_at ทบทวนเมื่อ
 * @property string|null $document_number เลขที่เอกสาร
 * @property float|null $document_revision แก้ไขครั้งที่
 * @property float|null $document_age อายุของเอกสาร
 * @property string|null $document_public_at วันที่ประกาศใช้
 * @property int|null $stamps_id ประทับตรา
 * @property string|null $document_ref เอกสารอ้างอิง
 * @property string|null $document_tags #tag
 * @property int|null $points_id จุดรับเอกสาร
 * @property string|null $reviewer_comment ความคิดเห็นของผู้ทบทวน
 * @property string|null $additional_training การอบรมเพิ่มเติม
 *
 * @property Approver[] $approvers
 * @property Points $points
 * @property Requester $requester
 * @property Stamps $stamps
 * @property User $reviewerName
 */
class Reviewer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviewer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requester_id', 'reviewer_name', 'stamps_id', 'points_id','approver_name'], 'integer'],
            [['document_revision', 'document_age'], 'number'],
            [['reviewer_comment', 'additional_training','approver_comment','approver_at'], 'string'],
            [['reviewer_at', 'document_public_at'], 'string', 'max' => 45],
            [['document_ref', 'document_tags'], 'string', 'max' => 255],
            [['points_id'], 'exist', 'skipOnError' => true, 'targetClass' => Points::class, 'targetAttribute' => ['points_id' => 'id']],
            [['requester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requester::class, 'targetAttribute' => ['requester_id' => 'id']],
            [['stamps_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stamps::class, 'targetAttribute' => ['stamps_id' => 'id']],
            [['reviewer_name'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['reviewer_name' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'requester_id' => Yii::t('app', 'requester_id'),
            'reviewer_name' => Yii::t('app', 'reviewer_name'),
            'reviewer_at' => Yii::t('app', 'reviewer_at'),
            'document_revision' => Yii::t('app', 'document_revision'),
            'document_age' => Yii::t('app', 'document_age'),
            'document_public_at' => Yii::t('app', 'document_public_at'),
            'stamps_id' => Yii::t('app', 'stamps_id'),
            'document_ref' => Yii::t('app', 'document_ref'),
            'document_tags' => Yii::t('app', 'document_tags'),
            'points_id' => Yii::t('app', 'points_id'),
            'reviewer_comment' => Yii::t('app', 'reviewer_comment'),
            'additional_training' => Yii::t('app', 'additional_training'),
            //
            'categories_id' => Yii::t('app', 'categories_id'),
            'reviewerName.profile.name' => Yii::t('app', 'reviewerName.profile.name'),
            //
            'approver_name' => Yii::t('app', 'approver_name'),
            'approver_at' => Yii::t('app', 'approver_at'),
            'approver_comment' => Yii::t('app', 'approver_comment'),
        ];
    }

    public function getApprovers()
    {
        return $this->hasMany(Approver::class, ['reviewer_id' => 'id']);
    }

    public function getPoints()
    {
        return $this->hasOne(Points::class, ['id' => 'points_id']);
    }

    public function getRequester()
    {
        return $this->hasOne(Requester::class, ['id' => 'requester_id']);
    }

    public function getStamps()
    {
        return $this->hasOne(Stamps::class, ['id' => 'stamps_id']);
    }
 
    public function getReviewerName()
    {
        return $this->hasOne(User::class, ['id' => 'reviewer_name']);
    }

    public function getApproverName()
    {
        return $this->hasOne(User::class, ['id' => 'approver_name']);
    }
}
