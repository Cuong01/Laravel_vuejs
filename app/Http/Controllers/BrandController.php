<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function list_brand()
    {
        $brands = Brand::get();
        return response()->json(['brands' => $brands]);
    }
    public function change_status($id)
    {
        $brand = Brand::find($id);

        $brand->update([
            'status' => !$brand->status
        ]);
    }
    public function add_brand(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy điền tên thương hiệu'
            ]
        );

        Brand::create([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);
    }

    public function show_brand($id)
    {
        $brand = Brand::find($id);
        return response()->json(['brand' => $brand]);
    }

    public function edit_brand(Request $request, $id)
    {
        $brand = Brand::find($id);
        $validated = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Hãy điền tên thương hiệu'
            ]
        );
        $brand->fill([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);
        $brand->update();
    }

    public function delete_brand(Request $request, $id)
    {
        $brand = Brand::where('id', $id)->delete();
    }
}
