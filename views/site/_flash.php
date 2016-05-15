<?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) 
                {
     echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
 