<?php
use app\components\Common;
use app\rbac\OwnPostRule;
use yii\helpers\Html;
?>
<article class="post hentry">
    <header class="post-header">
       <h3 class="content-title">Blog post title</h3>
       <div class="blog-entry-meta">
          <div class="blog-entry-meta-date">
             <i class="fa fa-clock-o"></i>
             <span class="blog-entry-meta-date-month">
                 <?= date('F', $model->updated_at); ?>   
             </span>
             <span class="blog-entry-meta-date-day">
                 <?= date('d', $model->updated_at); ?>,
             </span>
             <span class="blog-entry-meta-date-year">
                 <?= date('Y', $model->updated_at); ?>   
             </span>
          </div>
          <div class="blog-entry-meta-author">
             <i class="fa fa-user"></i>
             <a href="#" class="blog-entry-meta-author"><?= $model->author->username ?></a>
          </div>
          <div class="blog-entry-meta-tags">
             <i class="fa fa-tags"></i>
             <a href="#">Web Design</a>,
             <a href="#">Branding</a>
          </div>
          <div class="blog-entry-meta-comments">
             <i class="fa fa-comments"></i>
             <a href="#" class="blog-entry-meta-comments">4 comments</a>
          </div>
          <?php
            $canEdit = \Yii::$app->user->can('updatePost') || \Yii::$app->user->can('updateOwnPost',['post'=>$model]);
            $canDelete = \Yii::$app->user->can('deletePost') || \Yii::$app->user->can('deleteOwnPost',['post'=>$model]);
          if($canEdit || $canDelete) {
          ?>
          <div class="blog-entry-admin">
              <?php if($canEdit) { 
                $options = [
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ];
                echo Html::a('<i class="fa fa-edit"></i>', '/post/update/'.$model->id, $options);
              }
              if($canDelete) {
                $options = [
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'class' => 'blog-entry-admin-delete',
                ];
                echo Html::a('<i class="fa fa-remove"></i>', '/post/delete/'.$model->id, $options);
              }
              ?>
          </div> 
          <?php
          }
          ?>
       </div>
    </header>
    <div class="post-content">
       <p>
          <?= Common::substrBoundary($model->content, 600); ?>
       </p>
    </div>
    <footer class="post-footer">
       <a class="btn-small btn-color">Read More</a>
    </footer>
 </article>
<div class="blog-divider"></div>