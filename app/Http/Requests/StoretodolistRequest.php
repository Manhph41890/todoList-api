<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoretodolistRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after_or_equal:today',
            'priority' => 'nullable|string|in:normal,high,low',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'due_date.required' => 'Hạn chót không được để trống',
            'due_date.after_or_equal' => 'Hạn chót phải lớn hơn hoặc bằng ngày hiện tại',
            'priority.required' => 'Ưu tiên không được để trống'
        ];
    }
}
