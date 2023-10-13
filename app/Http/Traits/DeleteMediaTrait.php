<?php


namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait DeleteMediaTrait{


    public function DeleteMediaTrait($modelId, $mediaModel)
    {
//        dd($modelId);
        $allMediables = DB::table('mediables')->where('mediable_id', $modelId)->get();
        foreach ($allMediables as $mediable) {
            $media = $mediaModel->find($mediable->media_id);
            unlink(storage_path('app/public/' . $media->url));
            $media->delete();
        }
    }

}
