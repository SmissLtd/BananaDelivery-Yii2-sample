<?php

/**
 * @param app\models\PackSize[] $sizes
 */

use yii\helpers\Html;

$this->title = 'Banana delivery';
?>
<div class="site-index">
    <h1>Banana delivery calculator</h1><hr />
    
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h3>Available packs:</h3>
                <p>
                    <?php foreach ($sizes as $model): ?>
                        <?= $model->id; ?>: <?= Html::encode($model->title); ?><br />
                    <?php endforeach; ?>
                </p>
            </div>
            <div class="col-lg-4">
                <h3>Requested bananas:</h3>
                <?= Html::beginForm('', 'POST', ['id' => 'form-calculate']); ?>
                    <div class="form-group">
                        <?= Html::input('number', 'count', rand(1, 15000), ['class' => 'form-control', 'min' => 1, 'required' => 'required']); ?>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Calculate', ['class' => 'btn btn-primary']); ?>
                    </div>
                <?= Html::endForm(); ?>
            </div>
            <div class="col-lg-4">
                <h3>Packs to send:</h3>
                <div id="calculate-result"></div>
            </div>
        </div>
    </div>
</div>