<?php

namespace App\Http\Services;
use Illuminate\Support\ServiceProvider;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


/**
 * Created by Tarroumi mohamed on 06-2021
 * This service is created to upload file on server.
 */

class UploadFileService implements UploadFileInterface
{

    public function __construct()
    {
    }
    /**
     * Function to Upload File the server.
     * @param  \Illuminate\Http\Request  $request
     * @param  $path : the emplacement of file
     * @param  $types array of accepted types  
     * @return mixed
     */

    public function upload($file, $path, $types = null)
    {
        $fileName = $file->getClientOriginalName();
        $fileType =  $file->extension();
        $registredName = md5($fileName.now()).'.'.$fileType;
        $result = ['name'=> $registredName, 'type' =>$file->getClientMimeType(),'extension' =>  $fileType ];
       
       // dd(  $path);
        if ($types) {
            if (!$this->checkType($fileType, $types)) {
                throw new Exception(Config::get('errorcodes.messages.FILE_NOT_VALID'), Config::get('errorcodes.codes.FILE_NOT_VALID'));
            }
        }
        if ($file->isValid()) {
            try {

                $file->storeAs( $path, $registredName);
            } catch (\Throwable $th) {
                throw new Exception($th->getMessage());
            }
        }
        return $result;
    }

    /**
     * @param $filetype File type
     * @param $types array of accepted types
     * @return boolen  
     */
    public function checkType($fileType, $types)
    {
        return  in_array($fileType, $types);
    }
}
