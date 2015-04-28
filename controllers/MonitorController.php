<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\models\LogsMonitor;

class MonitorController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $data = array();
            $logs = LogsMonitor::find()->where('rendered!=1')->orderBy('date DESC')->all();
            if (count($logs)>0) $data['html'] = '';
            foreach ($logs as $log) {
                $q = $log->attributes;
                $q['user_name'] = $log->user->username;
                $data['html'] .= $this->renderPartial('_log',['q'=>$q]);
            }
            LogsMonitor::updateAll(['rendered'=>1]);
            return json_encode($data);
        }

        LogsMonitor::clearOld();
        $logs = LogsMonitor::find()->orderBy('date DESC')->all();
        LogsMonitor::updateAll(['rendered'=>1]);


        return $this->render('index',['logs'=>$logs]);
    }

}
