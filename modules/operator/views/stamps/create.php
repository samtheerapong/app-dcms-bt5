<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Stamps */

$this->title = Yii::t('app', 'Create Stamps');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stamps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stamps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
