<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/post', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/post', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/post', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/post', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:raw',
            [
                'label'=>\Yii::t('app/post','created_at'),
                'value'=>\Yii::$app->formatter->asDatetime($model->created_at),
            ],
            [
                'label'=>\Yii::t('app/post','updated_at'),
                'value'=>\Yii::$app->formatter->asDatetime($model->updated_at),
            ],
            [
                'label'=>\Yii::t('app/post','author'),
                'value'=>$model->author->username,
            ],
            'status',
        ],
    ]) ?>

</div>
