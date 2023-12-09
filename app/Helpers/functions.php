<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

if (!function_exists('apiResponse')) {
    /**
     * Unified Api Response
     * @param $success
     * @param $message
     * @param $statusCode
     * @param null $data
     * @return json
     */
    function apiResponse($success, $message, $statusCode, $data = null, $paginationData = null)
    {
        $response =  [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];

        if($paginationData){
            $response['pagination_data'] = $paginationData;
        }

        return response()->json($response, $statusCode);
    }
}

if (!function_exists('uploadFile')) {
    /**
     * upload File in specific directory "storage"
     * @param $file
     * @param $path
     * @return string
     */
    function uploadFile($file, $path): string
    {
        $checkPath = 'app/public/' . $path;
        if (!file_exists(storage_path($checkPath))) {
            mkdir(storage_path($checkPath), 777, true);
        }
        $fileName   = time() . $file->getClientOriginalName();
        Storage::disk('public')->put($path . '/' . $fileName, File::get($file));
        return $fileName;
    }
}

if (!function_exists('deleteFile')) {
    /**
     * delete File
     * @param $file
     * @param $path
     * @return int
     */
    function deleteFile($file, $folder): int
    {
        $filePath = explode('/',$file);
        $file = end($filePath);
        $fullPath = $folder . '/' . $file;
        
        if (Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->delete($fullPath);
        } else {
            return (7);
        }
        return true;
    }
}