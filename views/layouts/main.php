<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\LayoutAsset;
use pavlinter\stickyFooter\StickyFooter;

LayoutAsset::register($this);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>>">
	<meta name="viewport" content="width=device-width, intial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<?php $this->head() ?>
</head>

    <body style="padding-top: 70px;">
    	<?php $this->beginBody() ?>
    	<div class="wrap">
            <?= $content ?>
    	</div>
        <?php $this->endBody() ?> 
    </body>
</html>
<?php $this->endPage() ?>
