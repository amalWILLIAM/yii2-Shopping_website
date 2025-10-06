<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination; 

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);



        $dataProvider->pagination->pageSize = 5;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    
     public function actionCreate()
{
    $model = new Category();

    if ($model->load(Yii::$app->request->post())) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            $fileName = uniqid() . '.' . $model->imageFile->extension;

            // Paths for backend and frontend
            $backendPath  = Yii::getAlias('@backend/web/uploads/categories/') . $fileName;
            $frontendPath = Yii::getAlias('@frontend/web/uploads/categories/') . $fileName;

            // Ensure both folders exist
            if (!is_dir(dirname($backendPath))) mkdir(dirname($backendPath), 0755, true);
            if (!is_dir(dirname($frontendPath))) mkdir(dirname($frontendPath), 0755, true);

            // Save file to backend first
            if ($model->imageFile->saveAs($backendPath)) {
                // Copy to frontend
                copy($backendPath, $frontendPath);
                $model->image = $fileName; // Save only the filename in DB
            }
        }

        if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('create', ['model' => $model]);
}

public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post())) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            $fileName = uniqid() . '.' . $model->imageFile->extension;

            $backendPath  = Yii::getAlias('@backend/web/uploads/categories/') . $fileName;
            $frontendPath = Yii::getAlias('@frontend/web/uploads/categories/') . $fileName;

            if (!is_dir(dirname($backendPath))) mkdir(dirname($backendPath), 0755, true);
            if (!is_dir(dirname($frontendPath))) mkdir(dirname($frontendPath), 0755, true);

            if ($model->imageFile->saveAs($backendPath)) {
                copy($backendPath, $frontendPath);
                $model->image = $fileName;
            }
        }

        if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('update', ['model' => $model]);
}

 

    

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }




    
}
