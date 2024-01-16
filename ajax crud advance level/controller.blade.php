<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * blade title share
     * @param $title
     * @return \Illuminate\Http\Response
     */
    protected function setPageTitle($title='',$metaTitle='',$metaDesc='')
    {
        view()->share(['title' => $title,'metaTitle'=>$metaTitle,'metaDesc'=>$metaDesc]);
    }

          /**
     * New image upload
     * @param $file,$folderName,$width,$height
     * @return \Illuminate\Http\Response
     */
    protected function imageUpload($file, $folderName, $width, $height)
    {
        if ($file) {
            $folderName =  __FILE_PATH__.$folderName;
            // if not have a folder create folder
            !File::exists($folderName) ? File::makeDirectory($folderName, 0777, true, true) : false;

            // rename image
            $imageFile = $file->getClientOriginalName();
            $imageNameReplace = str_replace([' ',':','\\', '/', '*','()'],'-',$imageFile);
            $imageEx = explode('.',$imageNameReplace);
            $image = $imageEx[0].'_'.rand(111,999).'.'.end($imageEx);

            if ($width != null && $height != null) { // width and height null value check
                Image::make($file)->resize($width, $height)->save($folderName . $image); // resize image
                $path = $folderName.$image;
            }
            else{
                $file->move($folderName, $image); // not resize image
                $path = $folderName.$image;
            }
        }
        else{
            $path = null;
        }

        return $path;
    }

    /**
     * New image upload with old image delete storage
     * @param $file,$folderName,$width,$height,$defaultImage
     * @return \Illuminate\Http\Response
     */
    protected function imageUpdate($file, $folderName, $width, $height, $oldImage)
    {


        if ($file) {
            $folderName = __FILE_PATH__.$folderName;

            // old image delete from storage
            file_exists($oldImage) ? unlink($oldImage) : false;

            // if not have a folder create folder
            !File::exists($folderName) ? File::makeDirectory($folderName, 0777, true, true) : false;

            // rename image
            $imageFile = $file->getClientOriginalName();
            $imageNameReplace = str_replace([' ',':','\\', '/', '*','()'],'-',$imageFile);
            $imageEx = explode('.',$imageNameReplace);
            $image = $imageEx[0].'_'.rand(111,999).'.'.end($imageEx);

            if ($width != null && $height != null) { // width and height null value check
                Image::make($file)->resize($width, $height)->save($folderName . $image); // resize image
                $path = $folderName.$image;
            }
            else{
                $file->move($folderName, $image); // not resize image
                $path = $folderName.$image;
            }
            return $path;
        }
        else{
            return $oldImage;
        }

    }

    /**
     * Old image delete from storage
     * @param $oldImage
     * @return \Illuminate\Http\Response
     */
    protected function imageDelete($oldImage){
        if (file_exists($oldImage)) {
            $remove = unlink($oldImage);
        }
        else{
            $remove = false;
        }

        return $remove;
    }

     /**
     * ENV Data Set
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    protected function changeEnvData(array $data)
    {
        if (count($data) > 0) {
            $env = file_get_contents(base_path() . '/.env');
            $env = preg_split('/\s+/', $env);

            foreach ($data as $key => $value) {
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=", $env_value, 2);
                    if ($entry[0] == $key) {
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }
            $env = implode("\n", $env);

            file_put_contents(base_path() . '/.env', $env);
            return true;
        } else {
            return false;
        }
    }

}



// form store data 
$request->validate([
            'mail_mailer'       => 'required|string|in:smtp,sendmail,mail',
            'mail_host'         => 'required|string',
            'mail_username'     => 'required|string',
            'mail_password'     => 'required|string',
            'mail_from_address' => 'required|string',
            'mail_port'         => 'required|integer',
            'mail_encryption'   => 'required|string|in:tls,ssl,null'
        ]);

        // env set value
        $this->changeEnvData([
            'MAIL_MAILER'       => $request->mail_mailer,
            'MAIL_HOST'         => $request->mail_host,
            'MAIL_PORT'         => $request->mail_port,
            'MAIL_USERNAME'     => $request->mail_username,
            'MAIL_PASSWORD'     => $request->mail_password,
            'MAIL_ENCRYPTION'   => $request->mail_encryption,
            'MAIL_FROM_ADDRESS' => $request->mail_from_address
        ]);