<?php
 
namespace app\console\controllers;
 
use yii\console\Controller;
 
/**
 * Callback controller
 */
class HelloController extends Controller {
 
     /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex() {
       // echo "cron service runnning";
        echo "Hello";
        echo "\n";
    }
 
}
