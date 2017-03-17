<?php use Cygnite\Common\UrlManager\Url;
$asset = $view->createAssetCollection('\Apps\Views\Assets\BaseAssetCollection');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $title; ?></title>
    <meta name="keywords" content="CRUD Application" />
    <meta name="author" content="Cygnite Framework Bootstrap Starter Site." />
    <!-- Google will often use this as its description of your page/site. Make it good. -->
    <meta name="description" content="Cygnite CRUD Generator." />
    <!--  Mobile Viewport Fix -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="<?php echo Url::getBase(); ?>/public/assets/img/cygnite/fevicon.png" > </link>

    <?php $asset->where('header')->dump('style');// Header Style block ?>
    <style type="text/css">
        body {padding: 60px 0;}
        .navbar-inverse {background: none repeat scroll 0 0 #07508f!important;}
    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<!-- Fluid Container -->
<div class='container'>

    <!-- Navbar -->
    <?php echo $view->widget()->make('layouts:widgets:navbar'); ?>
    <!-- ./ Navbar -->

    <!-- Content -->
    <?php echo $yield; ?>
    <!-- ./ Content -->

    <!-- Footer -->
    <footer class="clearfix"></footer>
    <!-- ./ Footer -->

</div>
<!-- ./ Container End -->
<?php
// Footer Style block
$asset->where('footer')->dump('style');
//Script block. Scripts will render here
$asset->where('footer')->dump('script');
?>

<script type="text/javascript">
    $(function () {
        $('#dataGrid').DataTable();
    });
</script>
</body>
</html>