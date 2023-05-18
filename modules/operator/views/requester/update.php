<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Requester */

$this->title = Yii::t('app', 'Update') . ' : '.$model->document_number;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requesters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="requester-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
