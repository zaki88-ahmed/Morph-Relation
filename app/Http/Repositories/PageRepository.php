<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\CommentInterface;
use App\Http\Interfaces\PagetInterface;
use App\Http\Resources\CommentResource;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiDesignTrait;
//use App\Models\role;
use App\Http\Traits\CreateCoverTrait;
use App\Http\Traits\CreateLogoTrait;
use App\Http\Traits\CreateMediaTrait;
use App\Http\Traits\DeleteMediaTrait;
use App\Models\Comment;
use App\Models\Media;
use App\Models\Page;
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

class PageRepository implements PagetInterface {

    use ApiDesignTrait;
    use CreateMediaTrait;
    use DeleteMediaTrait;
    use CreateCoverTrait;
    use CreateLogoTrait;


    private $pageModel;
    private $mediaModel;


    public function __construct(Page $page, Media $media) {

        $this->pageModel = $page;
        $this->mediaModel = $media;
    }

    public function addPage($request){

        $page = $this->pageModel::create($request->all());

        if($request->logo){

            $this->CreateLogoTrait($request->logo, $page, '/page_logos');

        }
        if($request->cover){
            $this->CreateCoverTrait($request->cover, $page, '/page_covers');

        }
        return $this->ApiResponse(200, 'Page Was Created', null, PageResource::make($page));
    }

    public function allPages(){

        $page = $this->pageModel::get();
        return $this->ApiResponse(200, 'Done', null, PageResource::collection($page));
    }

    public function deletePAge($request){
        $page = $this->pageModel::find($request->page_id);
        if($page){
            $this->DeleteMediaTrait($page->id, $this->mediaModel);
            $page->delete();
            return $this->ApiResponse(200, 'Page Was Deleted', null, PageResource::make($page));
        }
        return $this->ApiResponse(422, 'This Page Not Found');
    }


    public function updatePage($request){

        $page = $this->pageModel::find($request->page_id);
        $page->update($request->all());
        $this->DeleteMediaTrait($page->id, $this->mediaModel);
        $page->logo = null;
        $page->cover = null;
        $page->save();
        if($request->logo){
            $this->CreateLogoTrait($request->logo, $page, '/page_logos');
        }
        if($request->cover){
            $this->CreateCoverTrait($request->cover, $page, '/page_covers');
        }

        return $this->ApiResponse(200, 'Page Was Updated', null, PageResource::make($page));
        }



    public function restorePage($request)
    {
        // TODO: Implement restorePage() method.
        $page = $this->pageModel->withTrashed()->find($request->page_id);
        if (!is_null($page->deleted_at)) {
            $page->restore();
            return $this->ApiResponse(200,'Page restored successfully');
        }
        return $this->ApiResponse(200,'Page already restored');
    }

    public function specificPage($request)
    {
        // TODO: Implement specificPage() method.
        $page = $this->pageModel::find($request->page_id);
        if($page){
            return $this->ApiResponse(200, 'Done', null, PageResource::make($page));
        }
        return  $this->ApiResponse(404, 'Not Found');

    }


    public function togglePage($request)
    {
        // TODO: Implement togglePage() method.
    }

    public function uploadCover($request)
    {
        // TODO: Implement uploadCover() method.
//        $page = $this->pageModel::find($request->page_id);
//        $this->DeleteMediaTrait($page->id, $this->mediaModel);
//        $page->cover = null;
//        $this->CreateCoverTrait($request->cover, $page, '/page_covers');
//        return $this->ApiResponse(200, 'Cover Was Updated', null, PageResource::make($page));
    }

    public function uploadLogo($request)
    {
        // TODO: Implement uploadLogo() method.
    }

    public function removePage($request)
    {
        // TODO: Implement removePage() method.
        $page = $this->pageModel::find($request->page_id);
        $page->forcedelete();
        return $this->ApiResponse(200, 'Page Was Updated', null, PageResource::make($page));
    }

    public function getTrashedPages($request)
    {
        // TODO: Implement getTrashedPages() method.
        $page = $this->pageModel::onlyTrashed()->get();
        return $this->ApiResponse(200, 'Done', null,  PageResource::collection($page));
    }
}
