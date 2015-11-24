<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'postid',
            //'userid',
            [
                'attribute'=>'title',
                'label'=>'标题',
                'format'=>'raw',
                'contentOptions'=>['class'=>'col-lg-8'],
                'enableSorting'=>false,
                'value'=>function($data){
                    return Html::a($data->title,Url::toRoute(['/post/view','id'=>$data->postid]));
                }
            ],
            'username',
            //'ip',
            [
                'attribute'=>'posttime',
                'label'=>'发表时间',
                'contentOptions'=>['class'=>'col-lg-2'],
                'enableSorting'=>false,
            ],
            // 'content:ntext',
            // 'tag',
        ],
    ]); ?>

</div>
