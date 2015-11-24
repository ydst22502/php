<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?=Html::encode(User::findIdentity($model->userid)->username)?>
                <p style="float:right">
                    <span class="glyphicon glyphicon-grain" aria-hidden="true"></span>
                    发表时间：<?=Html::encode($model->posttime)?>
                </p>
            </h3>
        </div>
        <div class="panel-body" style="height:200px;">
            <?=Html::encode($model->content)?>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">
                <?=Html::encode($model->tag)?>
            </h3>
        </div>
    </div>
    <p>
        <?php 
            if(!Yii::$app->user->isGuest && User::findIdentity($model->userid)->userid == Yii::$app->user->identity->userid)
            {
        ?>
                <?= Html::a('修改', ['update', 'id' => $model->postid], ['class' => 'btn btn-primary'])?>
                <?= Html::a('删除', ['delete', 'id' => $model->postid], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '你确定要删除这个主题吗？',
                        'method' => 'post',
                    ],
                ])?>
        <?php
            }
        ?>
    </p>

</div>
