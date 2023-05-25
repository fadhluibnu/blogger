<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'author' => 'sometimes|required',
            'title' => 'sometimes|required',
            'meta_desc' => 'sometimes|required',
            'slug' => [
                'sometimes',
                'required', 
                Rule::unique('posts')->where(fn ($query) => $query->where('slug', '!=', $this->slug)),
            ],
            'tag' => 'sometimes|required',
            'id_playlist' => 'sometimes|required',
            'id_category' => 'sometimes|required',
            'image_cover' => 'sometimes|required',
            'body' => 'sometimes|required',
            'views' => 'sometimes|required',
        ];
    }
}
