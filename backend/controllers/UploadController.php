<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UploadController extends Controller
{
    /**
     * Serves uploaded category images.
     * Example: /backend/web/index.php?r=upload/category&file=mobile1.jpg
     */
    public function actionCategory($file)
    {
        $filePath = \Yii::getAlias('@backend/web/uploads/category/') . $file;

        if (!file_exists($filePath)) {
            throw new NotFoundHttpException("File not found.");
        }

        return \Yii::$app->response->sendFile($filePath);
    }
}
