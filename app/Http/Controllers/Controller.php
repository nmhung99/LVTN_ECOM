<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function uploadImage($dir = '/image/image_product/', $image)
    {
    	$name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path($dir);
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath);
        }
        $image->move($destinationPath, $name);
        $url = $dir.$name;
        return $url;
    }
}
