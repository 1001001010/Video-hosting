<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category_list() {
        $categories = Category::get();
        return view('category', ['categories' => $categories]); 
    }

    public function new_category(Request $request) {
        $data = ([
            'name' => $request->category_name,
            'link' => $request->category_link,
        ]);
        Category::create($data);
        return redirect()->back();
    }
}
