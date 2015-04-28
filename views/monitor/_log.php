<?php
/* @var $this yii\web\View */
use app\models\LogsMonitor;

switch ($q['type']) {

    case 1:
        $color = 'green';
        break;
    case 2:
        $color = 'blue';
        break;
    case 3:
        $color = 'black';
        break;
    case 4:
        $color = 'red';
        break;
}

?>

<div class="log" style="color: <?=$color?>;">
    <div class="date"><?=date('H:i:s',$q['date']);?></div>
    <div class="text">
        <p class="title"><?=LogsMonitor::operationType($q['type']);?> "<?=$q['client_name'];?>" пользователем <?=$q['user_name'];?></p>
        <?php if ($q['field']) { ?>
        <p class="changes">изменено поле "<?=$q['field'];?>"
            <?php
            if ($q['old_value']) echo 'c "'.$q['old_value'].'"';
            if ($q['new_value']) echo ' на "'.$q['new_value'].'"';
            ?>
        </p>
        <?php } ?>
    </div>
</div>

