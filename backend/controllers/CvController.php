<?php

namespace backend\controllers;

use Yii;
use backend\models\Cv;
use backend\models\CvSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CvController implements the CRUD actions for Cv model.
 */
class CvController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'    =>  [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'index', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Cv models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CvSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cv model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cv model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cv();
        $model->scenario = 'create';
        
        if ($model->load(Yii::$app->request->post())) {
            $pict = $model->uploadImage();
            if($model->validate()){
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(FALSE)) { // validate model before save return boolean
                        // upload only if valid uploaded file instance found
                        if($pict !== FALSE){
                            $path = $model->getImageFile();
                            if($pict->saveAs($path)){
                                $flag = TRUE;
                            }else{
                                $flag = FALSE;
                            }
                        }
                        // end upload file
                    }
                    
                    if ($flag) {
                        $transaction->commit(); // save transaction
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $ex) {
                    $transaction->rollBack();
                }
            }else{
                return $this->render('create', [
                            'model' => $model,
                        ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cv model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        
        $oldFile = $model->getImageFile();
        $oldImage = $model->file;
        
        $start_date = explode('-', $model->start_date);
        $end_date = explode('-', $model->end_date);
        !empty($model->start_date) ? $model->start_date = $start_date[0].'-'.$start_date[1] : NULL;
        !empty($model->end_date) ? $model->end_date = $end_date[0].'-'.$end_date[1] : NULL;
            
        if ($model->load(Yii::$app->request->post())) {
            $image = $model->uploadImage();
            // revert back if image not valid
            if($image === FALSE){
                $model->file = $oldImage;
            }
            
            if($model->validate()){
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(FALSE)) { // validate model before save return boolean
                        // upload only if valid uploaded file instance found
                        if($image !== FALSE){
                            if(is_file($oldFile)){
                                unlink($oldFile);
                            }

                            $path = $model->getImageFile();
                            if($image->saveAs($path)){
                                $flag = TRUE;
                            }else{
                                $flag = FALSE;
                            }
                        }
                        // end upload file
                    }
                    
                    if ($flag) {
                        $transaction->commit(); // save transaction
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $ex) {
                    $transaction->rollBack();
                }
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cv model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cv model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cv the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cv::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
