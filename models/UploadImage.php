<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadImage
 */
class UploadImage extends Model
{

    /**
     * image
     *
     * @var mixed
     */
    public $image;

    /**
     * rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * upload
     *
     * @return bool|string
     */
    public function upload($id = 0)
    {
        if ($this->validate()) {
            $dir = "uploads/blog/{$id}";
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $image = "blog_{$id}_img.{$this->image->extension}";
            $url = "{$dir}/{$image}";
            $this->image->saveAs("$url");
            return $url;
        }

        return false;
    }
}