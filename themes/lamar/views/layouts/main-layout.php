<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$baseThemeUrl = Yii::$app->params['baseTheme'][1];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!------------------------------------------------------>
<body class="boxed home">
      <div class="page-mask">
            <div class="page-loader"> 

                <div class="spinner"></div>
                Loading...
            </div>

      </div>
      <div class="wrap">
         <!-- Header Start -->
         <header id="header">
            <!-- Header Top Bar Start -->
            <div class="top-bar">
               <div class="slidedown collapse">
                  <div class="container">
                     <div class="phone-email pull-left">
                        <a href="<?= Url::to(['site/contact']); ?>"><i class="fa fa-edit"></i>Contact us</a>
                        <a href="mailto:<?= Yii::$app->params['contactEmail']; ?>"><i class="fa fa-envelope"></i> Email : <?= Yii::$app->params['contactEmail']; ?></a>
                     </div>
                     <div class="follow-us pull-right">
                         <div class="social pull-left">
                             <?= (!Yii::$app->user->isGuest)? 'Ваш баланс: $'.round(Yii::$app->user->identity->balance->balance,2,PHP_ROUND_HALF_UP) : '&nbsp;' ?>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Header Top Bar End -->
            <!-- Main Header Start -->
            <div class="main-header">
               <div class="container">
                  <!-- TopNav Start -->
                  <div class="topnav navbar-header">
                     <a class="navbar-toggle down-button" data-toggle="collapse" data-target=".slidedown">
                     <i class="fa fa-angle-down icon-current"></i>
                     </a> 
                  </div>
                  <!-- TopNav End -->
                  <!-- Logo Start -->
                  <div class="logo pull-left">
                     <h1>
                        <a href="#">
                        <img src="<?= $baseThemeUrl ?>/img/logo.png" alt="pixma" width="125" height="60">
                        </a>
                     </h1>
                  </div>
                  <!-- Logo End -->
                  <!-- Mobile Menu Start -->
                  <div class="mobile navbar-header">
                     <a class="navbar-toggle" data-toggle="collapse" href=".navbar-collapse">
                     <i class="fa fa-bars fa-2x"></i>
                     </a> 
                  </div>
                  <!-- Mobile Menu End -->
                  <!-- Menu Start -->
                  <?php
                    NavBar::begin([
                      'renderInnerContainer' => false,
                          'options' => [
                              'class' => 'collapse navbar-collapse menu',
                          ],
                    ]);
                    $items = [
                        [
                            'label' => Html::a(
                                'Главная',
                                Yii::$app->homeUrl,
                                (Url::to('') == '/') ? ['id'=>'current'] : []
                            ),
                        ],
                        [
                            'label' => Html::a(
                                'item 1',
                                Url::to(['/item1']),
                                (Url::to('') == '/item1') ? ['id'=>'current'] : []
                            ),
                        ],
                        [
                            'label' => Html::a(
                                'item 2',
                                Url::to(['/item2']),
                                (Url::to('') == '/item2') ? ['id'=>'current'] : []
                            ),
                        ],
                        [
                            'label' => Html::a(
                                'item 3',
                                Url::to(['/item3']),
                                (Url::to('') == '/item3') ? ['id'=>'current'] : []
                            ),
                        ],
                        [
                            'label' => Html::a(
                                'Поддержка',
                                Url::to(['/site/contact']),
                                (Url::to('') == '/site/contact') ? ['id'=>'current'] : []
                            ),
                        ],

                    ];
                    if(Yii::$app->user->isGuest) {
                        array_push($items,
                            ['label' => 'Вход', 'url' => ['/user/login']],
                            ['label' => 'Регистрация', 'url' => ['/user/register']]
                        );
                    } else {
                        array_push($items,
                            [
                                'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                                'url' => ['/site/logout'],
                                'template' => '<li><a href="{url}" data-method="post">{label}</a></li>',
                            ]
                        );
                    }
                    echo Menu::widget([
                        'options' => ['class' => 'nav navbar-nav sf-menu'],
                        'items' => $items,
                        'encodeLabels' => false,
                    ]);

                    NavBar::end();
                  ?>
                  <!-- Menu End --> 
               </div>
            </div>
            <!-- Main Header End -->
         </header>
         <!-- Header End --> 
         <!-- Content Start -->
         <!------------------------------------------>
         <div id="main">
             <?php
                if($this->context->module->id != 'user') {
                    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                        echo yii\bootstrap\Alert::widget([
                            'options' => ['class' => 'alert-info'],
                            'body' => $key.': '.$message
                        ]);
                    }
                }
            ?>
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                             <h2 class="title"><?= Html::encode($this->title); ?></h2>
                         </div>
                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                             <div class="breadcrumbs pull-right">
                                 <?= Breadcrumbs::widget([
                                     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                     'options' => ['class' => false],
                                 ]); ?>
                             </div>
                         </div>
                    </div>
                </div>
            </div> 
             <!-- Main Content Start -->
             <div class="content main-content2">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 min-height-600">
                            <?= $content ?>
                       </div>
                   </div>
               </div>
             </div>
            <!-- Main Content End -->
         </div>
                
            
        
                
             <!------------------------------------------------>
         <!-- Footer Start -->
         <footer id="footer">
            <!-- Footer Top Start -->
            <div class="footer-top">
               <div class="container">
                  <div class="row">
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-one">
                        <h3>About</h3>
                        <p> 
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. 
                        </p>
                     </section>
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-two">
                        <h3>Twitter Stream</h3>
                        <ul id="tweets">
                        </ul>
                     </section>
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-three">
                        <h3>Contact Us</h3>
                        <ul class="contact-us">
                           <li>
                              <i class="fa fa-map-marker"></i>
                              <p> 
                                 <strong class="contact-pad">Address:</strong> House: 325, Road: 2,<br> Mirpur DOHS <br>
                                 Dhaka, Bangladesh 
                              </p>
                           </li>
                           <li>
                              <i class="fa fa-phone"></i>
                              <p><strong>Phone:</strong> +880 111-111-111</p>
                           </li>
                           <li>
                              <i class="fa fa-envelope"></i>
                              <p><strong>Email:</strong><a href="mailto:support@fifothemes.com">support@fifothemes.com</a></p>
                           </li>
                        </ul>
                     </section>
                     <section class="col-lg-3 col-md-3 col-xs-12 col-sm-3 footer-four">
                        <h3>Flickr Photostream</h3>
                        <ul id="flickrfeed" class="thumbs"></ul>
                     </section>
                  </div>
               </div>
            </div>
            <!-- Footer Top End --> 
            <!-- Footer Bottom Start -->
            <div class="footer-bottom">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 "> &copy; Copyright 2014 by <a href="#">Pixma</a>. All Rights Reserved. </div>
                     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                        <ul class="social social-icons-footer-bottom">
                           <li class="facebook"><a href="#" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                           <li class="twitter"><a href="#" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                           <li class="dribbble"><a href="#" data-toggle="tooltip" title="Dribble"><i class="fa fa-dribbble"></i></a></li>
                           <li class="linkedin"><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                           <li class="rss"><a href="#" data-toggle="tooltip" title="Rss"><i class="fa fa-rss"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Footer Bottom End --> 
         </footer>
         <!-- Scroll To Top --> 
         <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
      </div>
    <?php //var_dump(Url::current(),Url::to('')); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
