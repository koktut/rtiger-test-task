<?php

/**
 * Handles the creation of table `{{%booking}}`.
 */
class m200416_150618_create_booking_table extends \app\migrations\models\Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(),
            'hotel_room_id' => $this->integer()->notNull(),
            'name' => $this->string(255),
            'phone' => $this->string(255),
            'date_from' => $this->date()->notNull(),
            'date_to' => $this->date(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex('', 'booking', ['hotel_room_id']);
        $this->createIndex('', 'booking', ['date_from']);

        $this->addForeignKey('', 'booking', 'hotel_room_id', 'hotel_room', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking}}');
    }
}
