<?php

namespace app\jobs;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "failed_job".
 *
 * @property int $id
 * @property string $job_id
 * @property string $data
 * @property string|null $error_message
 * @property int $created_at
 */
class FailedJob extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queue_failed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'created_at', 'error_message'], 'required'],
            [['error_message'], 'string'],
            [['job_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'error_message' => 'Error Message',
            'created_at' => 'Created At',
        ];
    }
}
