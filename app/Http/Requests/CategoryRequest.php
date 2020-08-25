<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:120'],
            'slug' => $this->getSlugRules(),
            'parent_id' => ['nullable', 'numeric']
        ];

        return $rules;
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'categories.update'
            ? ['required']
            : ['sometimes'];

        $slug = Category::where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('categories', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
