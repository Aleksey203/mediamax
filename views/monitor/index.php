<?php
/* @var $this yii\web\View */

?>
<h1>Рабочий стол</h1>

<div id="box">
<?php foreach ($logs as $v) {
    $q = $v->attributes;
    $q['user_name'] = $v->user->username;
    echo $this->render('_log',['q'=>$q]);
 } ?>

</div>
<?php
$this->registerJsFile('/js/monitor.js',['depends'=>'app\assets\AppAsset']);
?>
