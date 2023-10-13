<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            case "addPage":
                $rules = [
                    'name' => 'required|string',
                    'about' => 'required|string',
                    'logo' => 'nullable',
                    'cover' => 'nullable',
                    'website' => 'required|string',
                    'phone' => 'required|string',
                    'location' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
            case "deletePage":
                $rules = [
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
                case "restorePage":
                $rules = [
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
            case "removePage":
                $rules = [
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
            case "specificPage":
                $rules = [
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
            case "updatePage":
                $rules = [
                    'name' => 'string',
                    'about' => 'string',
                    'logo' => 'nullable',
                    'cover' => 'nullable',
                    'website' => 'string',
                    'phone' => 'string',
                    'location' => 'string',
                    'category_id' => 'required|exists:categories,id',
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
            case "togglePage":
                $rules = [
                    'page_id' => 'required|exists:pages,id',
                ];
                break;
        }
        return $rules;
    }
}
