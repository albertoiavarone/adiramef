<?php
namespace App\Helpers;

use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Exception\NotReadableException;

class Files {

    public function createFile($name, $file){
        return Storage::disk(config('values.FILESYSTEM_DRIVER'))->put($name, $file);
    }

    public function deleteFile($file_path){
        return Storage::disk(config('values.FILESYSTEM_DRIVER'))->delete($file_path);
    }

    public function getExtension($data){
        if(is_object($data)){
            $extension = $data->getClientOriginalExtension();
        } else {
            $infoPath = pathinfo($data);
            $extension = $infoPath['extension'];
        }
        return $extension;
    }

    public function base64ToImage($path,$base64Data,$type='png'){
        $image = $base64Data;  // your base64 encoded
        switch($type){
            case "jpg":
                $image = str_replace('data:image/jpeg;base64,', '', $image);
            break;
            case "jpeg":
                $image = str_replace('data:image/jpeg;base64,', '', $image);
            break;
            default:
                $image = str_replace('data:image/png;base64,', '', $image);
        }

        $image = str_replace(' ', '+', $image);
        Storage::disk(config('values.FILESYSTEM_DRIVER'))->put($path, base64_decode($image));
    }

    public function uploadImage($uploaded_file,$path,$filename,$resize=false,$w=null,$h=null){

        if(!$uploaded_file->isValid()){
            return abort(400);
        }
        $image = $uploaded_file;
        $fileName = $filename . "." . $image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        if($resize){
            if(!$w){
                $w=200;
            }
            if(!$h){
                $h=$w;
            }
            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->stream(); // <-- Key point
        $fileName = $path.'/'.$fileName;
        Storage::disk(config('values.FILESYSTEM_DRIVER'))->put($fileName, $img);
        return $fileName;
    }

}
