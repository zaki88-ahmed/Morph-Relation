<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getPageRules($this->input('class'));
    }

    public function getPageRules($class){
        $rules = [];
        switch ($class){
            case "addPost":
                $rules = [
                    'name'=> 'required|string',
                    'about'=> 'required|string',
                    'website'=> 'required|string',
                    'phone'=> 'required|string',
                    'location'=> 'required|string',
                    'category_id' => 'required',
                    'page_id' => 'required'
                ];
                break;
            case "deletePost":
                $rules = [
                    'post_id' => 'required|exists:posts,id',
                ];
                break;
            case "updatePost":
                $rules = [
                    'content' => 'required',
//            '     status' => 'in:0,1',
                    'post_id' => 'required|exists:posts,id',
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
            case "specificPost":
                $rules = [
                    'post_id' => 'required|exists:posts,id',
                ];
                break;
        }
        return $rules;
    }
}
