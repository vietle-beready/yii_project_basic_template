<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Contact;

class ContactController extends Controller
{
    public function actionListContact()
    {
        $contacts = Contact::find()->all();
        foreach ($contacts as $contact) {
            echo 'email:' . $contact->email . ' - ' . 'name:' . $contact->name . ' - ' . 'subject:' . $contact->subject . ' - ' . 'body:' . $contact->body . PHP_EOL;
        }
    }
    public function actionFindContactByEmail($email)
    {
        $contacts = Contact::find()->where(['email' => $email])->all();
        if ($contacts) {
            foreach ($contacts as $contact) {
                echo 'email:' . $contact->email . ' - ' . 'name:' . $contact->name . ' - ' . 'subject:' . $contact->subject . ' - ' . 'body:' . $contact->body . PHP_EOL;
            }
        } else {
            echo 'Contact not found' . PHP_EOL;
        }
    }
}
