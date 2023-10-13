<?php


namespace App\Http\Traits;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

trait CreateCoverTrait{


    public function CreateCoverTrait($request, $model, $path){

            $mediaUrl = Storage::disk('public')->put($path, $request);
            $media = new Media();
            $media->type = 'post';
            $media->url = $mediaUrl;
            $media->save();
            $model->medias()->attach($media->id, ['type'=>'post']);
            $model->cover = $mediaUrl;
            $model->save();
    }

}
