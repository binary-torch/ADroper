<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationFormRequest extends FormRequest
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
        return [
            "application_type_id" => "required|exists:application_types,id",
            "course_id"           => "required|exists:courses,id",
            "section_id"          => "required|exists:sections,id"
        ];
    }
}
