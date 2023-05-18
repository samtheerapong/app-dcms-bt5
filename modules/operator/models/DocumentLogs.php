<?php

namespace app\modules\operator\models;

use Yii;

/**
 * This is the model class for table "document_logs".
 *
 * @property int $id
 * @property int|null $requester_id
 * @property int|null $reviewer_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $document_name
 * @property string|null $document_revision
 * @property string|null $document_fullname
 */
class DocumentLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requester_id', 'reviewer_id'], 'integer'],
            [['created_at', 'updated_at', 'document_name', 'document_revision', 'document_fullname'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'requester_id' => Yii::t('app', 'Requester ID'),
            'reviewer_id' => Yii::t('app', 'Reviewer ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'document_name' => Yii::t('app', 'Document Name'),
            'document_revision' => Yii::t('app', 'Document Revision'),
            'document_fullname' => Yii::t('app', 'Document Fullname'),
        ];
    }
}
