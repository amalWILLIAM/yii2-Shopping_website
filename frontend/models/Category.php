<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        // The table exists in backend DB, make sure the DB connection in frontend config can access it
        return 'category';
    }

    public function getImageUrl()
{
    if ($this->image) {
        // Use the frontend URL
        return Yii::getAlias('@web') . '/uploads/categories/' . $this->image;
    }
    return null; // or a default image path
}

}
