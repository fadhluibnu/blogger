<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'author' => 'required',
            'title' => 'required',
            'meta_desc' => 'required',
            'slug' => 'required|unique:posts,slug',
            'tag' => 'required',
            'id_playlist' => 'sometimes|required',
            'id_category' => 'sometimes|required',
            'image_cover' => 'required',
            'body' => 'required',
            'views' => 'sometimes|required',
        ];
    }
}
