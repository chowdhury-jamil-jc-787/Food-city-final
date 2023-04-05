<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // return [
        //     'title' => 'required|unique:categories,title',
        //     'description' => 'required',
        //     'is_active' => 'required',
        //     'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:5000',
        //     'created_at' => 'required',
        // ];

        $categoryValidationRole = 'mimes:jpg,png,jpeg,webp|max:1000';
        if ($this->isMethod('post')) {
            $categoryValidationRole = 'required|'.$categoryValidationRole;
           
        }
        return [
            'title'=>['required','unique:categories,title'],
            'is_active'=>['required'],
            'description'=>['max:1000'],
            'created_at'=>['required'],
            'image'=>$categoryValidationRole
        ];
    }

    }

