<?php
namespace App\Http\Interfaces;


interface PagetInterface {


    public function addPage($request);

    public function allPAges();

    public function deletePage($request);

    public function restorePage($request);

    public function specificPage($request);

    public function updatePage($request);

    public function togglePage($request);

    public function uploadCover($request);

    public function uploadLogo($request);

    public function removePage($request);

    public function getTrashedPages($request);

}
