<?php
namespace App\Http\Interfaces;


interface CategoryInterface {


    public function addCategory($request);

    public function allCategories();

    public function deleteCategory($request);

    public function restoreCategory($request);

    public function specificCategory($request);

    public function updateCategory($request);


    public function removeCategory($request);


}
