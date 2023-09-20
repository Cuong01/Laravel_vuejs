<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Spatie\Backtrace\File;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function list_product()
    {
        $products = Product::all();
        $categoris = Category::all();
        $brands = Brand::all();
        return response()->json([
            'products' => $products,
            'categoris' => $categoris,
            'brands' => $brands,
        ]);
    }
    public function show_product($id)
    {
        $product = Product::find($id);
        return response()->json([
            'product' => $product,
        ]);
    }
    public function get_category()
    {
        $category = Category::where('status', 1)->get();
        return response()->json([
            'category' => $category,
        ]);
    }
    public function get_brand()
    {
        $brands = Brand::where('status', 1)->get();
        return response()->json([
            'brands' => $brands,
        ]);
    }
    public function change_status($id)
    {
        $product = Product::find($id);

        $product->update([
            'status' => !$product->status
        ]);
    }
    public function add_product(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'count' => 'required|numeric',
                'content' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png,gif',
            ],
            [
                'name.required' => 'Không được để trống',
                'price.required' => 'Không được để trống',
                'price.numeric' => 'Hãy điền số',
                'count.required' => 'Không được để trống',
                'count.numeric' => 'Hãy điền số',
                'content.required' => 'Không được để trống',
                'brand_id.required' => 'Hãy chọn thương hiệu sản phẩm',
                'category_id.required' => 'Hãy chọn danh mục sản phẩm',
                'image.image' => 'Hãy thêm đúng file ảnh',
                'image.mimes' => 'Hãy thêm ảnh có đuôi: jpeg,jpg,png,gif',
            ]
        );

        if ($request['image']) {
            $image = $request->file('image');
            $extension  = $image->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $data1 = $image->storeAs('public', $name);
        } else {
            $name = 'default.jpg';
        }

        Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'image' => $name,
            'count' => $request['count'],
            'content' => $request['content'],
            'brand_id' => $request['brand_id'],
            'category_id' => $request['category_id'],
            'status' => $request['status'],
        ]);
    }
    public function edit_product(Request $request, $id)
    {
        $product = Product::find($id);
        $validated = $request->validate(
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'count' => 'required|numeric',
                'content' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Không được để trống',
                'price.required' => 'Không được để trống',
                'price.numeric' => 'Hãy điền số',
                'count.required' => 'Không được để trống',
                'count.numeric' => 'Hãy điền số',
                'content.required' => 'Không được để trống',
                'brand_id.required' => 'Hãy chọn thương hiệu sản phẩm',
                'category_id.required' => 'Hãy chọn danh mục sản phẩm',
            ]
        );
        if ($request['image'] != $product->image) {
            $validated = $request->validate(
                [
                    'image' => 'image|mimes:jpeg,jpg,png,gif',
                ],
                [
                    'image.image' => 'Hãy thêm đúng file ảnh',
                    'image.mimes' => 'Hãy thêm ảnh có đuôi: jpeg,jpg,png,gif',
                ]
            );
            $image = $request->file('image');
            $extension  = $image->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $data1 = $image->storeAs('public', $name);

            $product->fill([
                'name' => $request['name'],
                'price' => $request['price'],
                'count' => $request['count'],
                'content' => $request['content'],
                'brand_id' => $request['brand_id'],
                'category_id' => $request['category_id'],
                'status' => $request['status'],
                'image' => $name,
            ]);
        } else {
            $product->fill([
                'name' => $request['name'],
                'price' => $request['price'],
                'count' => $request['count'],
                'content' => $request['content'],
                'brand_id' => $request['brand_id'],
                'category_id' => $request['category_id'],
                'status' => $request['status'],
            ]);
        }

        $product->update();
    }
    public function delete_product(Request $request, $id)
    {
        $product = Product::where('id', $id)->delete();
    }
}
