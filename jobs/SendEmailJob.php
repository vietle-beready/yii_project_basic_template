<?php

namespace app\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;
use yii\queue\RetryableJobInterface;
use yii\queue\Queue;
use \app\jobs\FailedJob;

class SendEmailJob extends BaseObject implements RetryableJobInterface
{
    public $to;
    public $subject;
    public $body;
    public $attempt_limit = 2;

    public function execute($queue)
    {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }

    public function getTtr()
    {
        return 2 * 60;
    }

    public function canRetry($attempt, $error)
    {
        var_dump("canRetry called with attempt: $attempt");
        Yii::error("canRetry called with attempt: $attempt and error: " . $error->getMessage(), 'queue');
        if ($attempt >= $this->attempt_limit) {
            $this->saveQueueFailed($attempt, "Attempt limit reached");
            return false;
        }

        if ($error instanceof \Throwable) {
            $this->saveQueueFailed($attempt, $error->getMessage());
            return true;
        }

        return false;
    }

    public function saveQueueFailed($queueId, $message)
    {
        $failedJob = new FailedJob();
        $failedJob->job_id = $queueId;
        $failedJob->error_message = $message;
        $failedJob->created_at = time();
        return $failedJob->save();
    }
}
