<?php

use yii\db\Migration;
use yii\db\Schema;

class m170214_083640_dish extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%dish}}', [
			'id'     => Schema::TYPE_PK,
			'name'   => Schema::TYPE_STRING ,
			'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
		], $tableOptions);
		$this->createIndex('idx_dish_name', '{{%dish}}', 'name');

		$this->createTable('{{%ingredient}}', [
			'id'     => Schema::TYPE_PK,
			'name'   => Schema::TYPE_STRING ,
			'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
		], $tableOptions);
		$this->createIndex('idx_ingredient_name', '{{%ingredient}}', 'name');

		$this->createTable('{{%dish_ingredient}}', [
			'dish_id'       => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
			'ingredient_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
		], $tableOptions);
		$this->addPrimaryKey('dish-ingredient_pk', '{{%dish_ingredient}}', ['dish_id', 'ingredient_id']);

		$this->batchInsert('{{%dish}}', ['id', 'name', 'status'], [
			['1', 'Каша манная', '0' ],
			['2', 'Перловка', '0' ],
			['3', 'Хинкал', '0' ],
			['4', 'Гречка', '0' ],
			['5', 'Плов', '0' ],
		]);

		$this->batchInsert('{{%ingredient}}', ['id', 'name', 'status'], [
			['1', 'Мука', '0'],
			['2', 'Чеснок', '0'],
			['3', 'Зелень', '0'],
			['4', 'Масло растительное', '0'],
			['5', 'Вода', '0'],
			['6', 'Крупа гречневая', '0'],
			['7', 'Соль', '0'],
			['8', 'Крупа манная', '0'],
			['9', 'Молоко', '0'],
			['10', 'Сахар', '0'],
			['11', 'Баранина', '0'],
			['12', 'Рис', '0'],
			['13', 'Мясо', '0'],
		]);

		$this->batchInsert('{{%dish_ingredient}}', ['dish_id', 'ingredient_id'], [
			['1', '8'],
			['1', '9'],
			['1', '10'],
			['1', '7'],
			['1', '13'],
			['4', '7'],
			['4', '4'],
			['4', '5'],
			['4', '6'],
			['5', '12'],
			['5', '11'],
			['5', '7'],
			['3', '13'],
		]);
	}

	public function down()
	{
		$this->dropTable('{{%dish}}');
		$this->dropTable('{{%ingredient}}');
		$this->dropTable('{{%dish_ingredient}}');
	}
}
