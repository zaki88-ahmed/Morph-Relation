<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return $this->getCategoryRules($this->input('class'));
    }

    public function getCategoryRules($class){
        $rules = [];
        switch ($class){
            case "addCategory":
                $rules = [
                    'name' => 'required|string',
                ];
                break;
            case "deleteCtegory":
                $rules = [
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
                case "restoreCategory":
                $rules = [
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
            case "removeCategory":
                $rules = [
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
            case "specificCategory":
                $rules = [
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
            case "updateCategory":
                $rules = [
                    'name' => 'string',
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
        }
        return $rules;
    }
}
