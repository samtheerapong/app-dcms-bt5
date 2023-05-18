<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property string|null $document_number
 * @property string|null $document_revision
 * @property string|null $document_title
 * @property int|null $requester_by
 * @property string|null $requester_at
 * @property string|null $details
 * @property string|null $covenant
 * @property string|null $docs
 * @property string|null $document_age
 * @property string|null $document_public_at
 * @property int|null $stamps_id
 * @property string|null $document_tags
 * @property int|null $points_id
 * @property string|null $additional_training
 * @property int|null $reviewer_by
 * @property string|null $reviewer_at
 * @property string|null $reviewer_comment
 * @property int|null $approve_by
 * @property string|null $approve_at
 * @property string|null $approver_comment
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requester_by', 'stamps_id', 'points_id', 'reviewer_by', 'approve_by'], 'integer'],
            [['details', 'covenant', 'docs', 'additional_training', 'reviewer_comment', 'approver_comment'], 'string'],
            [['document_number', 'document_revision', 'requester_at', 'document_age', 'document_public_at', 'document_tags', 'reviewer_at', 'approve_at'], 'string', 'max' => 45],
            [['document_title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_number' => Yii::t('app', 'Document Number'),
            'document_revision' => Yii::t('app', 'Document Revision'),
            'document_title' => Yii::t('app', 'Document Title'),
            'requester_by' => Yii::t('app', 'Requester By'),
            'requester_at' => Yii::t('app', 'Requester At'),
            'details' => Yii::t('app', 'Details'),
            'covenant' => Yii::t('app', 'Covenant'),
            'docs' => Yii::t('app', 'Docs'),
            'document_age' => Yii::t('app', 'Document Age'),
            'document_public_at' => Yii::t('app', 'Document Public At'),
            'stamps_id' => Yii::t('app', 'Stamps ID'),
            'document_tags' => Yii::t('app', 'Document Tags'),
            'points_id' => Yii::t('app', 'Points ID'),
            'additional_training' => Yii::t('app', 'Additional Training'),
            'reviewer_by' => Yii::t('app', 'Reviewer By'),
            'reviewer_at' => Yii::t('app', 'Reviewer At'),
            'reviewer_comment' => Yii::t('app', 'Reviewer Comment'),
            'approve_by' => Yii::t('app', 'Approve By'),
            'approve_at' => Yii::t('app', 'Approve At'),
            'approver_comment' => Yii::t('app', 'Approver Comment'),
        ];
    }
}
