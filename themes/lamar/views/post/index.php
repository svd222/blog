<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/post', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/post', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div id="blog-content">
    <?= ListView::widget([
       'dataProvider' => $dataProvider, 
       'itemView' => '_post',
       'layout' => "{items}\n{pager}"
    ]); ?>
    </div>
    
</div>
