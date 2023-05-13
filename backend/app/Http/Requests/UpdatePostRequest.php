<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePostRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->title ?
        $this->merge([
            'slug' => Str::slug($this->title),
        ]) : null;
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
            'author' => 'sometimes|required',
            'title' => 'sometimes|required',
            'meta_desc' => 'sometimes|required',
            'slug' => 'sometimes|required|unique:posts,slug',
            'tag' => 'sometimes|required',
            'id_playlist' => 'sometimes|required',
            'id_category' => 'sometimes|required',
            'image_cover' => 'sometimes|required',
            'body' => 'sometimes|required',
            'views' => 'sometimes|required',
        ];
    }
}
