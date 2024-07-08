<?php

namespace app\models;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

class SendEmailJob extends BaseObject implements JobInterface
{
    public $to;
    public $subject;
    public $body;

    public function execute($queue)
    {
        try {
            Yii::$app->mailer->compose()
                ->setFrom('viet.le@beready.academy')
                ->setTo($this->to)
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
        } catch (\Exception $e) {
            Yii::error("Error occurred while sending email: " . $e->getMessage(), 'queue');
        }
    }
}
