<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */

    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['jpg', 'png']],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFile as $imageFile){
                $imageFile->saveAs(Yii::getAlias('@app').'/web/img/' . $imageFile->baseName . '.' . $imageFile->extension);
            }
            return true;
        } else {
            return false;
        }
    }
    
}
