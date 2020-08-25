<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Support\Traits\HasCrudAction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use HasCrudAction;

    protected $with = ['children'];

    protected $model = Category::class;

    protected $validation = CategoryRequest::class;

    protected $resources = CategoryResource::class;
}
