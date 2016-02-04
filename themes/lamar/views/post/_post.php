<?php
use app\components\Common;
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