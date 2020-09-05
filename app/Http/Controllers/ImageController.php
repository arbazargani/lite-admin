<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function SafeAssetsRender($slug)
    {
        $image = File::get('storage/uploads/certifications/' . $slug);
        return response()->make($image, 200, ['content-type' => 'image/jpg']);
    }
}
