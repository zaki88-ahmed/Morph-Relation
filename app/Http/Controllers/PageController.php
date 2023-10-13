<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CommentInterface;
use App\Http\Interfaces\PagetInterface;
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



class PageController extends Controller
{


    private $pageInterface;

    public function __construct(PagetInterface $pageInterface)
    {
        $this->pageInterface = $pageInterface;
    }

    public function addPage(PageRequest $request)
    {
        //dd($request);
        return $this->pageInterface->addPage($request);
    }

    public function allPAges()
    {
        //dd($request);
        return $this->pageInterface->allPAges();
    }

    public function deletePage(PageRequest $request)
    {

        return $this->pageInterface->deletePage($request);
    }

    public function restorePage(PageRequest $request)
    {

        return $this->pageInterface->restorePage($request);
    }


    public function specificPage(PageRequest $request)
    {

        return $this->pageInterface->specificPage($request);
    }


    public function updatePage(PageRequest $request)
    {

        return $this->pageInterface->updatePage($request);
    }

    public function togglePage(PageRequest $request)
    {

        return $this->pageInterface->togglePage($request);
    }

    public function uploadCover(PageRequest $request)
    {

        return $this->pageInterface->uploadCover($request);
    }

    public function uploadLogo(PageRequest $request)
    {

        return $this->pageInterface->uploadLogo($request);
    }

    public function removePage(PageRequest $request)
    {

        return $this->pageInterface->removePage($request);
    }

    public function getTrashedPages(PageRequest $request)
    {

        return $this->pageInterface->getTrashedPages($request);
    }


}











