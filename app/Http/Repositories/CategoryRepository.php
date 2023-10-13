<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Interfaces\CommentInterface;
use App\Http\Interfaces\PagetInterface;
use App\Http\Resources\CategoryResource;
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
use App\Models\Category;
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

class CategoryRepository implements CategoryInterface {

    use ApiDesignTrait;
    use CreateMediaTrait;
    use DeleteMediaTrait;
    use CreateCoverTrait;
    use CreateLogoTrait;


    private $categoryModel;


    public function __construct(Category $category) {

        $this->categoryModel = $category;
    }

    public function addCategory($request){

        $category = $this->categoryModel::create($request->all());

        return $this->ApiResponse(200, 'Category Was Created', null, CategoryResource::make($category));
    }

    public function allCategories(){

        $category = $this->categoryModel::get();
        return $this->ApiResponse(200, 'Done', null, CategoryResource::collection($category));
    }

    public function deleteCategory($request){
        $category = $this->categoryModel::find($request->category_id);
        if($category){
            $category->delete();
            return $this->ApiResponse(200, 'Category Was Deleted', null, CategoryResource::make($category));
        }
        return $this->ApiResponse(422, 'This Category Not Found');
    }


    public function updateCategory($request){

        $category = $this->categoryModel::find($request->category_id);
        $category->update($request->all());

        return $this->ApiResponse(200, 'Category Was Updated', null, CategoryResource::make($category));
        }



    public function restoreCategory($request)
    {
        // TODO: Implement restorePage() method.
        $category = $this->categoryModel->withTrashed()->find($request->category_id);
        if (!is_null($category->deleted_at)) {
            $category->restore();
            return $this->ApiResponse(200,'Category restored successfully');
        }
        return $this->ApiResponse(200,'Category already restored');
    }

    public function specificCategory($request)
    {
        // TODO: Implement specificPage() method.
        $category = $this->categoryModel::find($request->category_id);
        if($category){
            return $this->ApiResponse(200, 'Done', null, CategoryResource::make($category));
        }
        return  $this->ApiResponse(404, 'Not Found');

    }


    public function removeCategory($request)
    {
        // TODO: Implement removePage() method.
        $category = $this->categoryModel::find($request->category_id);
        $category->forcedelete();
        return $this->ApiResponse(200, 'Category Was Updated', null, CategoryResource::make($category));
    }

}
