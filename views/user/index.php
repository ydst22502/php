<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\widgets\ActiveForm;

$this->title = $user->username;
$this->params['breadcrumbs'][] = ['label' => '用户信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?=Html::encode('用户名')?>
                
            </h3>
        </div>
        <div class="panel-body">
            <?=Html::encode($user->username)?>
        </div>

        <div class="panel-heading">
            <h3 class="panel-title">
                <?='个人简介'?>
            </h3>
        </div>
        <div class="panel-body">
            <?=Html::encode($user->introduction)?>
        </div>


    </div>


</div>
