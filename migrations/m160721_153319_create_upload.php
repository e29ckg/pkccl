<?php

use yii\db\Migration;

class m160721_153319_create_upload extends Migration {

    public function up() {
        $this->createTable('upload', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'image' => $this->string(),
            'files' => $this->string(),
        ]);
    }

    public function down() {
        echo "m160721_153319_create_upload cannot be reverted.\n";
        $this->dropTable('upload');
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
