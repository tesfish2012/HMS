<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class FileService
{
    public static function storeFile($request, $fieldName)
    {
        if (!$request->file($fieldName))
            return null;
        $image=$request->file($fieldName);
        $filePath = storage_path('public/upload');
        $fileName = time().'.'.$image->getClientOriginalExtension();

        $moved=$image->move($filePath, $fileName);
        if($moved){
            return $fileName;
        }

    }

    public static function getFileUrl($models, $uri)
    {
        $fileBaseUrl = url('/') . $uri;

        foreach ($models as $model) {
            $model->featured_photo = isset($model->featured_photo)
                ?
                $fileBaseUrl .
                $model->featured_photo
                :
                null;
        }

        return $models;
    }

    public static function downloadFile($path, $fileName)
    {
        $path = storage_path('/'.$path).$fileName ;
        
        // $file = File::get($path);
        // str_replace('\\', '/', public_path())
       return response(str_replace('\\', '/',$path));
    }
        
    
}