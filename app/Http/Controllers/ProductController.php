<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //product create page
    public function create(){
        $categories = Category::get();

        return view("admin.product.productCreate", compact("categories"));
    }

    //product Create
    public function productCreate(Request $request){
        $this->checkproductValidation($request,'create');
        $data = $this->requestData($request);

        // if($request->hasFile("image")){
        //     $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        //     $request->file('image')->move(public_path() . "/product/" . $fileName);
        //     $data['image'] = $fileName;

        //     Product::create($data);
        //     Alert::success('Success!', 'Product Created successfully.');
        //     return back();

        // }

        if ($request->hasFile("image")) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path("product"), $fileName);

            $data['image'] = $fileName;

            Product::create($data);
            Alert::success('Success!', 'Product Created successfully.');
            return back();
        }
    }

    //product list => search section => low amount data => join database table
    public function productList($amt = 'default'){
        $product = Product::select('products.id','categories.name as category_name','products.name','products.image','products.stock','products.price')
        ->leftJoin("categories",'products.category_id','categories.id')
        ->when(request("searchKey"), function($querr){
                $querr->whereAny(['categories.name','products.name'], 'like' , '%' . request('searchKey') . '%');
            });

        if($amt != 'default'){
            $product = $product->where('stock',"<=",5);
        }

        $product = $product->orderBy("products.created_at",'desc')->paginate(5);
        return view("admin.product.list",compact('product'));
    }

    //product Update
    public function updatePage($id){
        $categories = Category::get();
        $productData = Product::where('id',$id)->first();
        return view('admin.product.update', compact('categories','productData'));
    }

    //product update
    public function updateProduct(Request $request){
        $this->checkproductValidation($request,'update');
        $productUpdate = $this->requestData($request);

        if($request->hasFile('image')){
            $imagePathWay = public_path('product/' . $request->oldImage);
            if(file_exists($imagePathWay)){
                unlink($imagePathWay);
            }

            $newfile = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path("product"), $newfile);
            $productUpdate['image'] = $newfile;
        }else{
            $productUpdate['image'] = $request->oldImage;
        }

        Product::where('id',$request->productId)->update($productUpdate);
        Alert::success('Success!', 'Product Updated successfully.');
        return to_route('productList');
    }

    //product delete
    public function productDelete($id){
        $productDelte = Product::find($id);

        $imagePath = public_path('product/' . $productDelte->image);
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        $productDelte->delete();
        Alert::success('Success!', 'Product Deleted successfully.');
        return back();
    }

    //product Details Page
        public function productDetails($id){
        $products = Product::select(
            'products.id',
            'categories.name as category_name',
            'products.description',
            'products.name',
            'products.image',
            'products.stock',
            'products.price'
        )
        ->leftJoin("categories",'products.category_id','categories.id')
        ->where('products.id', $id)
        ->first();

        // Check if $products is null
        if (!$products) {
            return redirect()->route('productList')->with('error', 'Product not found.');
        }

        return view("admin.product.details", compact("products"));
    }


    private function requestData($request){
        return [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->CategoryId,
            'description' => $request->description,
        ];
    }

    private function checkproductValidation($request,$action){
        $rules = [
            'name' => 'required|max:30,' . $request->productId,
            'price' => 'required',
            'stock' => 'required|max:999|numeric',
            'CategoryId' => 'required',
            'description' => 'required|max:2000',
        ];

        $rules['image'] = $action == 'update' ? 'mimes:png,jpg,jpeg,webp|file' : 'required|mimes:png,jpg,jpeg,webp|file';

        $message =[];

        $request->validate($rules,$message);
    }
}
