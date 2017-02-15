<?php

namespace akim04\dish\models\common;

use Yii;
use akim04\dish\Module;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%dish}}".
 *
 * @property string $name
 * @property integer $status
 */
class Ingredient extends ActiveRecord
{
	const STATUS_ACTIVE = 0;
	const STATUS_HIDDEN = 1;

	public static function tableName()
	{
		return '{{%ingredient}}';
	}

	public static function find()
	{
		return new IngredientQuery(get_called_class());
	}

	public function behaviors()
	{
		return [
		];
	}

	 public function rules()
	{
		return [
			['name', 'required'],

			['status', 'integer'],
			['status', 'default', 'value' => self::STATUS_ACTIVE],
			['status', 'in', 'range' => array_keys(self::getStatusesArray())],

			[['name'], 'string'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'     => Module::t('module', 'Id'),
			'name'   => Module::t('module', 'Name'),
			'status' => Module::t('module', 'Status'),
		];
	}

	public static function getStatusesArray()
	{
		return [
			self::STATUS_ACTIVE => Module::t('module', 'Active'),
			self::STATUS_HIDDEN => Module::t('module', 'Hidden'),
		];
	}

	public function getStatusName()
	{
		 return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
	}
}
