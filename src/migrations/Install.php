<?php
namespace phuongpt\powerapi;

use Craft;
use craft\db\Migration;

class Install extends Migration
{
    public function safeUp()
    {
        // Don't make the same config changes twice
//        if (Craft::$app->projectConfig->get('plugins.powerapi', true) === null) {
            if (!$this->db->tableExists('{{%products}}')) {
                // create the products table
                $this->createTable('{{%products}}', [
                    'id' => $this->integer()->notNull(),
                    'price' => $this->integer()->notNull(),
                    'currency' => $this->char(3)->notNull(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                    'PRIMARY KEY(id)',
                ]);

                // give it a FK to the elements table
                $this->addForeignKey(
                    $this->db->getForeignKeyName('{{%products}}', 'id'),
                    '{{%products}}', 'id', '{{%elements}}', 'id', 'CASCADE', null);
            }
//        }
    }

    public function safeDown()
    {

    }
}