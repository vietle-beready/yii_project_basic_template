<?php

namespace app\models;

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
        return 'failed_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'data', 'created_at'], 'required'],
            [['data', 'error_message'], 'string'],
            [['created_at'], 'integer'],
            [['job_id'], 'string', 'max' => 255],
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
            'data' => 'Data',
            'error_message' => 'Error Message',
            'created_at' => 'Created At',
        ];
    }
}
