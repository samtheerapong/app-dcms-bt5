<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\PrivateRequester */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Private Requesters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="private-requester-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelReviewer' => $modelReviewer,
    ]) ?>

</div>
