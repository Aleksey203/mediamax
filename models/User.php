<?php

namespace app\models;

use app\models\LogsMonitor;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function getLogs()
    {
        return $this->hasMany(LogsMonitor::className(), ['user_id' => 'id']);
    }
}
