<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Logs $model */

$this->title = Yii::t('app', 'Create Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
