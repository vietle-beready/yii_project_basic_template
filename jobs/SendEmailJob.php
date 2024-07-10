<?php

namespace app\jobs;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;
use yii\queue\RetryableJobInterface;
use yii\queue\Queue;

// class SendEmailJob extends BaseObject implements RetryableJobInterface
// {
//     public $to;
//     public $subject;
//     public $body;
//     public $attempt_limit = 2;

//     public function execute($queue)
//     {
//         try {
//             Yii::$app->mailer->compose()
//                 ->setFrom(Yii::$app->params['senderEmail'])
//                 ->setTo($this->to)
//                 ->setSubject($this->subject)
//                 ->setTextBody($this->body)
//                 ->send();
//         } catch (\Exception $e) {
//             Yii::error("Error occurred while sending email: " . $e->getMessage(), 'queue');
//         }
//     }
//     public function getTtr()
//     {
//         return 2 * 60;
//     }

//     public function canRetry($attempt, $error)
//     {
//         $errorMessager = "";
//         $status = true;
//         if ($error instanceof \Exception) {
//             $errorMessager = $error->getMessage();
//             $status = false;
//         }
//         if ($attempt == $this->attempt_limit && !empty($this->model)) {
//             $status = false;
//             $errorMessager = "attempt limit reached";
//         }
//         if ($status == false  && !empty($this->model)) {
//             $this->saveQueueFailed($this->model->queue_id, $errorMessager);
//         }
//         return ($attempt < $this->attempt_limit && $status);
//     }

//     public function saveQueueFailed($queueId, $message)
//     {
//         $failedJob = new \app\models\FailedJob();
//         $failedJob->job_id = $this->jobId;
//         $failedJob->data = json_encode($this->data);
//         $failedJob->error_message = 'Job failed for some reason'; // Có thể sử dụng thông tin lỗi thực tế ở đây
//         $failedJob->created_at = time();

//         return $failedJob->save();

//         return false;
//     }
// }




class SendEmailJob extends BaseObject implements JobInterface
{
    public $to;
    public $subject;
    public $body;

    public function execute($queue)
    {
        try {
            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['senderEmail'])
                ->setTo($this->to)
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
        } catch (\Exception $e) {
            Yii::error("Error occurred while sending email: " . $e->getMessage());
        }
    }
}
