<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiDesignTrait;
//use App\Models\role;
use App\Http\Traits\CreateMediaTrait;
use App\Http\Traits\DeleteMediaTrait;
use App\Models\Media;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

use App\Http\Interfaces\PostInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\countOf;

class PostRepository implements PostInterface{
    use ApiDesignTrait;
    use CreateMediaTrait;
    use DeleteMediaTrait;

    private $postModel;
    private $mediaModel;


    public function __construct(Post $post, Media $media) {

        $this->postModel = $post;
        $this->mediaModel = $media;
    }


    public function addPost($request){

           $post = $this->postModel::create([
               'content' => $request->content,
               'status' => $request->status,
               'page_id' => $request->page_id,
              ]);

           $post->pages()->attach($request->page_id, [
               'post_id' => $post->id
           ]);

        if($request->media){
            $this->CreateMediaTrait($request->media, $post, '/post_medias');
        }

       return $this->ApiResponse(200, 'Post Was Created', null, PostResource::make($post));
    }

    public function allPosts(){

        $posts = $this->postModel::get();
        return $this->ApiResponse(200, 'Done', null,  PostResource::collection($posts));
    }

    public function deletePost($request){

        $post = $this->postModel::find($request->post_id);
        if($post){
            $post->delete();
            $this->DeleteMediaTrait($post->id, $this->mediaModel);
            return $this->ApiResponse(200, 'Post Was Deleted', null, $post);
        }
        return $this->ApiResponse(422, 'This Post Not Found');
    }


    public function updatePost($request){

        $post = $this->postModel::find($request->post_id);

        $post->update($request->all());
//
        $post->pages()->sync($request->page_id);
//        dd($post->pages);
            if($request->media){
                $this->DeleteMediaTrait($post->id, $this->mediaModel);
                $this->CreateMediaTrait($request->media, $post, '/post_medias');

        }
            return $this->ApiResponse(200, 'Post Was Updated', null, PostResource::make($post));
        }


    public function specificPost($request){

        $post = $this->postModel->find($request->post_id);

        if($post){
            return  $this->ApiResponse(200, 'Done', null, PostResource::make($post));
        }
        return  $this->ApiResponse(404, 'Not Found');

    }

    public function deleteMedia($allMediables)
    {
        foreach ($allMediables as $mediable) {
            $media = $this->mediaModel::find($mediable->media_id);
            unlink(storage_path('app/public/' . $media->url));
            $media->delete();
        }
    }

        public function createMedia($request, $model){

                foreach ($request as $media){
//                    dd($media);
                    $mediaUrl = Storage::disk('public')->put('/post_medias', $media);
                    $media = new Media();
                    $media->type = 'post';
                    $media->url = $mediaUrl;
                    $media->save();
                    $model->medias()->attach($media->id, ['type'=>'post']);
                }
            }


}
