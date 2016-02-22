<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/posts', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if(\Yii::$app->user->can('createPost')) :
    ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php
    endif;
    ?>
    <?php
        if(!Yii::$app->user->identity->getIsAdmin()) {
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_post',
                'layout' => "{items}\n{pager}"
            ]);
        } else {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    'content:ntext',
                    'created_at',
                    'updated_at',
                    // 'author_id',
                    // 'status',

                    ['class' => 'yii\grid\ActionColumn'],
            ],]); 
        }    ?>

</div>
