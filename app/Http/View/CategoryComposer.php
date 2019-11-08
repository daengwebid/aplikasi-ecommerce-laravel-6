<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::with(['child'])->withCount(['child'])->getParent()->orderBy('name', 'ASC')->get();
        $view->with('categories', $categories);
    }
}