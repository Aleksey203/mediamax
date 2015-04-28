<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $birthday
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'birthday'], 'required'],
            [['birthday'], 'date', 'format' => 'yyyy-MM-dd'],
            [['name'], 'string', 'max' => 125],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'фамилия',
            'email' => 'email',
            'birthday' => 'дата рождения',
        ];
    }

    public function afterDelete()
    {
        $type = 4;
        $client_name = $this->name;
        $logs = new Logs();
        $logs->setAttributes([
            'date'=>time(),
            'type'=>$type,
            'client_name'=>$client_name,
            'user_id'=>Yii::$app->user->identity->id,
        ]);
        $logs->save(false);

        parent::afterDelete();
    }


    public function afterSave($insert, $changedAttributes)
    {
        $time = time();
        $client_name = $this->name;
        if ($insert) {
            $type = 1;
            $logs = new Logs();
            $logs->setAttributes([
                'date'=>$time,
                'type'=>$type,
                'client_name'=>$client_name,
                'user_id'=>Yii::$app->user->identity->id,
            ]);
            $logs->save(false);
        }
        else {
            $type = 2;
            $logs = new Logs();
            foreach ($changedAttributes as $field => $value) {
                $logs = new Logs();
                $logs->setAttributes([
                    'date'=>$time,
                    'type'=>$type,
                    'client_name'=>$client_name,
                    'user_id'=>Yii::$app->user->identity->id,
                    'field'=>$this->getAttributeLabel($field),
                    'old_value'=>$value,
                    'new_value'=>$this->$field,
                ]);
                $logs->save(false);
                unset($logs);
            }

        }


        parent::afterSave($insert, $changedAttributes);
    }
}
