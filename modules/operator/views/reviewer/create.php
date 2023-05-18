<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Reviewer */

$this->title = Yii::t('app', 'Create Reviewer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviewers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
