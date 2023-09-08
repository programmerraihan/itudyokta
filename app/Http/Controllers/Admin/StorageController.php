<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class StorageController extends Controller
{
    public function downloadLocal(Request $request)
    {
        // php artisan backup:run --only-db
        $backup = Artisan::call('backup:run --only-db');
        $files = Storage::files("coxs");
        $images = array();
        foreach ($files as $key => $value) {
            $value = str_replace("coxs/", "", $value);
            array_push($images, $value);
        }
        return response()->download(storage_path('app/coxs/' . $value));
    }

    //get file from public store
    public function downloadPublic($filename)
    {
        $file = Storage::disk('coxs')->get($filename);
        return (new Response($file, 200))
            ->header('Content-Type', 'image/jpeg', 'zip');
    }
}
