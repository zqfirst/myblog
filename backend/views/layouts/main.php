<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use \yii\web\View;

AppAsset::register( $this );
$this->registerCssFile( '/public/bootstrap/css/bootstrap.min.css' );
$this->registerCssFile( '/public/plugins/libs/ajax/font-awesome.min.css' );
$this->registerCssFile( '/public/plugins/libs/ajax/ionicons.min.css' );
$this->registerCssFile( '/public/dist/css/AdminLTE.min.css?a=1' );
$this->registerCssFile( '/public/dist/css/skins/_all-skins.min.css' );
$this->registerCssFile( '/public/plugins/laypage/skin/laypage.css' );
$this->registerCssFile( '/public/plugins/layer/skin/default/layer.css' );
$this->registerJsFile( '/public/plugins/jQuery/jquery-2.2.3.min.js', [ 'position' => View::POS_HEAD ] );
$this->registerJsFile( '/public/bootstrap/js/bootstrap.min.js', [ 'position' => View::POS_HEAD ] );
$this->registerJsFile( '/public/plugins/sparkline/jquery.sparkline.min.js' );
$this->registerJsFile( '/public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' );
$this->registerJsFile( '/public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' );
$this->registerJsFile( '/public/plugins/knob/jquery.knob.js' );
$this->registerJsFile( '/public/plugins/libs/js/moment.min.js' );
$this->registerJsFile( '/public/plugins/datepicker/bootstrap-datepicker.js' );
$this->registerJsFile( '/public/plugins/slimScroll/jquery.slimscroll.min.js' );
$this->registerJsFile( '/public/plugins/fastclick/fastclick.js' );
$this->registerJsFile( '/public/dist/js/app.min.js' );
$this->registerJsFile( '/public/plugins/layer/layer.js' );
$this->registerJsFile( '/public/plugins/laypage/laypage.js' );
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode( isset( $this->title ) && $this->title ? $this->title : '我的博客' ) ?></title>

	<?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/system/index/index" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>后台</b>管理系统</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><<?=\Yii::$app->user->identity ? \Yii::$app->user->getIdentity()->username : ''?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    <?=\Yii::$app->user->identity ? \Yii::$app->user->getIdentity()->username : ''?>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="javascript:;" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/login/login-out" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle=""></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <ul class="sidebar-menu">
				<?php foreach ( $this->context->indexMenu as $menu ): ?>
                    <li class="<?= isset($this->context->currentFunction) && $this->context->currentFunction->parent_id == $menu['id'] ? 'active' :'' ?> treeview">
                        <a href="javascript:;">
                            <i class="<?=$menu['class']?>"></i>
                            <span><?= $menu['name'] ?></span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
						<?php if ( isset( $menu['childLevel'] ) && $menu['childLevel'] ): ?>
                            <ul class="treeview-menu">
                                <?php foreach ($menu['childLevel'] as $subMenu): ?>
                                <li class="<?=isset($this->context->currentFunction) && $this->context->currentFunction->id == $subMenu['id'] ? 'active' :''?>">
                                    <a href="<?=$subMenu['route']?>"><i class="<?=$subMenu['class']?>"></i> <?=$subMenu['name']?> </a>
                                </li>
                                <?php endforeach;?>
                            </ul>
						<?php endif; ?>
                    </li>
				<?php endforeach; ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
		<?= $content ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- jQuery 2.2.3 -->
<!--    <script src="/public/plugins/jQuery/jquery-2.2.3.min.js"></script>-->
<!--    <!-- jQuery UI 1.11.4 -->
<!--    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
<!--    <!-- Bootstrap 3.3.6 -->
<!--    <script src="/public/bootstrap/js/bootstrap.min.js"></script>-->
<!--    <!-- Sparkline -->
<!--    <script src="/public/plugins/sparkline/jquery.sparkline.min.js"></script>-->
<!--    <!-- jvectormap -->
<!--    <script src="/public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>-->
<!--    <script src="/public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!--    <!-- jQuery Knob Chart -->
<!--    <script src="/public/plugins/knob/jquery.knob.js"></script>-->
<!--    <!-- daterangepicker -->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>-->
<!--    <script src="/public/plugins/daterangepicker/daterangepicker.js"></script>-->
<!--    <!-- datepicker -->
<!--    <script src="/public/plugins/datepicker/bootstrap-datepicker.js"></script>-->
<!--    <!-- Bootstrap WYSIHTML5 -->
<!--    <script src="/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->
<!--    <!-- Slimscroll -->
<!--    <script src="/public/plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
<!--    <!-- FastClick -->
<!--    <script src="/public/plugins/fastclick/fastclick.js"></script>-->
<!--    <!-- AdminLTE App -->
<!--    <script src="/public/dist/js/app.min.js"></script>-->
<!--    <!-- AdminLTE for demo purposes -->
<!--    <script src="/public/dist/js/demo.js"></script>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
