<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\CommentInterface;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiDesignTrait;
//use App\Models\role;
use App\Http\Traits\CreateMediaTrait;
use App\Http\Traits\DeleteMediaTrait;
use App\Models\Comment;
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

class CommentRepository implements CommentInterface {

    use ApiDesignTrait;
    use CreateMediaTrait;
    use DeleteMediaTrait;


    private $commentModel;
    private $mediaModel;


    public function __construct(Comment $comment, Media $media) {

        $this->commentModel = $comment;
        $this->mediaModel = $media;
    }

    public function addComment($request){

        $comment = $this->commentModel::create([
            'content' => $request->content,
            'isHidden' => $request->isHidden,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
        ]);


        if($request->media){
            $this->CreateMediaTrait($request->media, $comment, '/comment_medias');
        }

        return $this->ApiResponse(200, 'Comment Was Created', null, CommentResource::make($comment));
    }

    public function allComments(){

        $comment = $this->commentModel::get();
        return $this->ApiResponse(200, 'Done', null,  CommentResource::collection($comment));
    }

    public function deleteComment($request){
        $comment = $this->commentModel::find($request->comment_id);
        if($comment){
            $comment->delete();
            $this->DeleteMediaTrait($comment->id, $this->mediaModel);
            return $this->ApiResponse(200, 'Comment Was Deleted', null, CommentResource::make($comment));
        }
        return $this->ApiResponse(422, 'This Comment Not Found');
    }


    public function updateComment($request){

        $comment = $this->commentModel::find($request->comment_id);
//        if(!$comment){
//            return $this->ApiResponse(422,'Validation Error', 'Not Comment Exist');
//        }
        $comment->update($request->all());
        if($request->media){
            $this->DeleteMediaTrait($comment->id, $this->mediaModel);
            $this->CreateMediaTrait($request->media, $comment, '/comment_medias');

        }
        return $this->ApiResponse(200, 'Comment Was Updated', null, CommentResource::make($comment));
        }


    public function specificComment($request){
        $comment = $this->commentModel->find($request->comment_id);
        if($comment){
            return  $this->ApiResponse(200, 'Done', null, CommentResource::make($comment));
        }
        return  $this->ApiResponse(404, 'Not Found');

    }

    public function toggleComment($request){
        $comment = $this->commentModel->find($request->comment_id);
//        dd($comment->content);
        if($comment) {
            $comment->update([
                'isHidden' => !$comment->isHidden,
            ]);
//            dd($comment->content);
//            return  $this->ApiResponse(200, 'Done', null, $comment);
            return  $this->ApiResponse(200, 'Done', null, CommentResource::make($comment));
        }
        return  $this->ApiResponse(404, 'Not Found');
    }
}
