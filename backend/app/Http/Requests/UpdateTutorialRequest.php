<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorialRequest extends FormRequest
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
        // return $this->tutorials;
        return [
            'title' => 'sometimes|required',
            'image' => 'sometimes|required',
            'slug' => [
                'sometimes', 
                'required', 
                Rule::unique('tutorials')->where(fn ($query) => $query->where('slug', '!=', $this->slug)),
            ],
            'roadmap_id' => 'sometimes',
            'description' => 'sometimes|required'
        ];
    }
}
