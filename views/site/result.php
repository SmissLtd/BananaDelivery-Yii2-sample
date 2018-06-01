<?php

/**
 * @param array $packs
 */

use yii\helpers\Html;
?>
<?php foreach ($packs as $pack): ?>
    <?= Html::encode($pack['size']->title); ?>: <?= Yii::$app->formatter->asInteger($pack['count']); ?><br />
<?php endforeach; ?>