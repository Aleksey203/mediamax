<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property string $id
 * @property integer $type
 * @property string $user_id
 * @property string $field
 * @property string $old_value
 * @property string $new_value
 * @property string $client_id
 * @property string $date
 */
class Logs extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'client_name', 'date'], 'required'],
            [['type', 'user_id', 'date'], 'integer'],
            [['old_value', 'new_value', 'client_name'], 'string'],
            [['field'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'тип операции',
            'user_id' => 'ID пользователя',
            'field' => 'измененное поле',
            'old_value' => 'старое значение',
            'new_value' => 'новое значение',
            'client_name' => 'фамилия клиента',
            'date' => 'дата события',
        ];
    }

        public function beforeSave($insert)
    {
        $logsMonitor = new LogsMonitor();
        $logsMonitor->setAttributes($this->attributes);
        $logsMonitor->rendered = 0;
        $logsMonitor->save(false);

        return parent::beforeSave($insert);

    }
}
