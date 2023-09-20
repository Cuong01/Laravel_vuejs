<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list_category()
    {
        $category = Category::get();
        return response()->json(['category' => $category]);
    }
    public function change_status($id)
    {
        $category = Category::find($id);

        $category->update([
            'status' => !$category->status
        ]);
    }
    public function add_category(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy điền tên danh mục'
            ]
        );

        Category::create([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);
    }

    public function show_category($id)
    {
        $category = Category::find($id);
        return response()->json(['brand' => $category]);
    }

    public function edit_category(Request $request, $id)
    {
        $category = Category::find($id);
        $validated = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy điền tên danh mục'
            ]
        );
        $category->fill([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);
        $category->update();
    }

    public function delete_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->delete();
    }
}
