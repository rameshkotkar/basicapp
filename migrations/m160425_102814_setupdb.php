<?php

use yii\db\Migration;

class m160425_102814_setupdb extends Migration
{
    public function up()
    {
        $sqlPath=Yii::$app->basePath.'/migrations';
        //set database str
        $sql = file_get_contents($sqlPath.'/basicapp.sql');
        $this->execute($sql);
    }

    public function down()
    {
        echo "Setupdb cannot be reverted.\n";
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
