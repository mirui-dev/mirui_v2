<?php

namespace App\Http\Internals;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\InternalStatic;

class MiruiFile{

    public function save($file, $directory = 'unset', $disk = 'mirui-static'){

        $genericFailValidator = Validator::make(
            [
                'generic' => null,
            ],
            [
                'generic' => 'bail|required|integer',
            ],
            [
                'generic.*' => 'An error occured while processing file upload. <br><br>Changes discarded. ',
            ]
        );
        
        $validation = Validator::make(
            [
                'file' => $file,
            ],
            [
                // 'file' => 'bail|required|file|size:16384',  // 16MB = 16384KB
                'file' => 'bail|required|file', 
            ],
            [
                'file.required' => 'No file selected. Please try again. ',
                'file.size' => 'Woah, hang on there! Your file is too big! <br>Try something less than 16MB, please QAQ',
                'file.*' => 'Invalid file. Please try again. ',
            ]
        );
        
        if($validation->fails()){
            // https://laravel.com/docs/9.x/validation#working-with-error-messages
            // dump($validation);
            return $validation;
        }

        $store = Storage::disk($disk)->putFile($directory, $file);

        if($store){

            // save image to resource
            $internalStatic = new InternalStatic();
            $internalStatic->disk = $disk;
            $internalStatic->path = $store;
            $staticStore = $internalStatic->save();
            // dump($saveDashen->save());
            // dump(Storage::url($saveDashen->path));

            if(!$staticStore){
                return $genericFailValidator;
            }

            return $internalStatic;
        }

        return $genericFailValidator;
    }

    public function saveImage($imageFile, $directory, $disk){
        
        $validation = Validator::make(
            [
                'imageFile' => $imageFile,
            ],
            [
                'imageFile' => 'bail|required|image|max:2000',  // 2MB = 2000KB (aprox.). 2MB is PHP default limit. 
                // 'imageFile' => 'bail|required|file|size:16384',  // 16MB = 16384KB
                // 'imageFile' => 'bail|required|file', 
            ],
            [
                'imageFile.required' => 'No picture selected. Please try again. ',
                'imageFile.size' => 'Oi, your profile picture too big already la! (╬ Ò﹏Ó)<br><br><strong>2MB MAXIMUM HELLO</strong>',
                'imageFile.*' => 'Invalid image. Ensure that the image is an image... (o-_-o)',
            ]
        );
        
        if($validation->fails()){
            // https://laravel.com/docs/9.x/validation#working-with-error-messages
            // dump($validation);
            return $validation;
        }
        
        return self::save($imageFile, $directory, $disk);
    }

    public function get($static_id){

        $genericFailValidator = Validator::make(
            [
                'generic' => null,
            ],
            [
                'generic' => 'bail|required|integer',
            ],
            [
                'generic.*' => 'File not found. Please double triple check and try again. ',
            ]
        );

        // $db_profile_picture_path = $db_profile_picture ? 'url('.Storage::disk(\App\Models\InternalStatic::find($db_profile_picture)->disk)->url(\App\Models\InternalStatic::find($db_profile_picture)->path).')' : '';

        $internalStatic = InternalStatic::find($static_id);

        if(!$internalStatic){
            return false;
        }

        return $internalStatic;

        // $filepath = Storage::disk($internalStatic->disk)->url($internalStatic->path);

        // return $filepath;
    }

    public function getURL($static_id){
        $file = self::get($static_id);

        if($file instanceof InternalStatic){

            $fileURL = Storage::disk($file->disk)->url($file->path);

            return $fileURL;
        }

        return false;
    }

    public function getFile($static_id){
        $file = self::get($static_id);

        if($file instanceof InternalStatic){

            $fileContent = Storage::disk($file->disk)->get($file->path);

            return $fileContent;
        }
        
        return false;
    }

    public function download($static_id, $download_as = 'mirui-download'){
        $file = self::get($static_id);

        if($file instanceof InternalStatic){

            $fileDownload = Storage::disk($file->disk)->download($file->path, $download_as);

            return $fileDownload;
        }
        
        return false;
    }

}
