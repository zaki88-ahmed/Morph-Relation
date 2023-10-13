<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CategoryInterface;
use App\Http\Interfaces\CommentInterface;
use App\Http\Interfaces\PagetInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PageRequest;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Traits\ApiDesignTrait;



use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use App\Http\Interfaces\PostInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//use App\Http\Interfaces\PostInterface;
//use App\Http\Interfaces\PostInterface;



class CategoryController extends Controller
{


    private $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function addCategory(CategoryRequest $request)
    {
        //dd($request);
        return $this->categoryInterface->addCategory($request);
    }

    public function allCategories()
    {
        //dd($request);
        return $this->categoryInterface->allCategories();
    }

    public function deleteCategory(CategoryRequest $request)
    {

        return $this->categoryInterface->deleteCategory($request);
    }

    public function restoreCategory(CategoryRequest $request)
    {

        return $this->categoryInterface->restoreCategory($request);
    }


    public function specificCategory(CategoryRequest $request)
    {

        return $this->categoryInterface->specificCategory($request);
    }


    public function updateCategory(CategoryRequest $request)
    {

        return $this->categoryInterface->updateCategory($request);
    }


    public function removeCategory(CategoryRequest $request)
    {

        return $this->categoryInterface->removeCategory($request);
    }




}











