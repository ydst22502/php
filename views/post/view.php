<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\widgets\ActiveForm;



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
                <?=Html::a(User::findIdentity($model->userid)->username, ['user/view', 'id' => $model->userid])?>
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
                <?="标签:".Html::encode($model->tag)?>
            </h3>
        </div>

        <?php foreach($replies as $reply): ?>
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?=Html::a(User::findIdentity($reply->userid)->username, ['user/view', 'id' => $reply->userid])?>
                    <p style="float:right">
                        <span class="glyphicon glyphicon-grain" aria-hidden="true"></span>
                        发表时间：<?=Html::encode($reply->replytime)?>
                    </p>
                </h3>
            </div>
            <div class="panel-body" style="height:200px;">
                <?=Html::encode($reply->content)?>
            </div>            
        <?php endforeach; ?>

    </div>

    <?php 
        if(!Yii::$app->user->isGuest)
        {
    ?>
    <div class="reply-form">
        <?php 
            $form = ActiveForm::begin(
                [
                    'method' => 'post',
                    'action' => ['post/reply','id' => $model->postid]
                ]
            ); 
        ?>

        <?= $form->field($newreply, 'content')->textarea(['rows' => 6]) ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <?php
        }
        else
        {
            echo(Html::encode("请登录以评论"));
        }
    ?>

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
