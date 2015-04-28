<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs_monitor".
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
class LogsMonitor extends \yii\db\ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function operationType($type)
    {
        $operations = [
            1=>'создание записи',
            2=>'редактирование записи',
            3=>'просмотр записи',
            4=>'удаление записи',
        ];

        return $operations[$type];
    }

    //удаление старых записей
    public static function clearOld($seconds=300)
    {
        $date = time() - $seconds;
        LogsMonitor::deleteAll('date < :date',[':date' => $date]);

        return true;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs_monitor';
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
            [['rendered'] , 'default', 'value' => '0'],
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
            'field' => 'изменённое поле',
            'old_value' => 'старое значение',
            'new_value' => 'новое значение',
            'client_name' => 'ID клиента',
            'date' => 'дата события',
            'rendered' => 'была показана',
        ];
    }
}
