<?php

/**
 * Handles the creation of table `{{%hotel_room}}`.
 */
class m200416_142601_create_hotel_room_table extends \app\migrations\models\Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        $this->createTable('{{%hotel_room}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->string(255),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
        ]);

        $this->createIndex('', 'hotel_room', ['number']);

        $this->getDb()
            ->createCommand()
            ->batchInsert('hotel_room', ['number', 'name', 'description'], [
                [1, 'Номер 1', 'Описание 1'],
                [2, 'Номер 2', 'Описание 2'],
                [3, 'Номер 3', 'Описание 3'],
                [4, 'Номер 4', 'Описание 4'],
                [5, 'Номер 5', 'Описание 5'],
            ])
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hotel_room}}');
    }
}
