<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\Reply;
use app\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $pagination=new Pagination([
            'totalCount'=>Reply::find()->where(['postid' => $id])->count(),
        ]);
        $newreply = new Reply();
        $replies=Reply::find()->where(['postid' => $id])->orderBy('replytime')->offset($pagination->offset)->limit($pagination->limit)->all();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'pagination' => $pagination,
            'replies' => $replies,
            'newreply' => $newreply,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->gohome();
        }
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->postid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        if (Yii::$app->user->isGuest)
        {
            return $this->gohome();
        }
        $model = $this->findModel($id);
        if(User::findIdentity($model->userid)->userid != Yii::$app->user->identity->userid)
        {
            return $this->goBack();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->postid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->gohome();
        }
        $model = $this->findModel($id);
        if(User::findIdentity($model->userid)->userid != Yii::$app->user->identity->userid)
        {
            return $this->goBack();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionReply($id)
    {
        $model = new Reply();
        $model->postid = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['post/view', 'id' => $model->postid]);
        } else {
            return $this->redirect(['post/view', 'id' => $model->postid]);
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
