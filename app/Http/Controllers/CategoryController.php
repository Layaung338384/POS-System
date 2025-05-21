<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function list(){
       $categories = Category::orderBy("created_at",'desc')->get();
        return view("admin.category.list", compact("categories"));
    }

    //create category
    public function create(Request $request){
        $this->checkValidation($request);

        Category::create([
            'name' => $request->CategoryName
        ]);

        Alert::success('Created Success Title', 'Catregory Created Successfully!');
        return back();

    }


    //delete
    public function delete($id){
    $category = Category::findOrFail($id);
    $category->delete();

    Alert::success('Deleted!', 'Category deleted successfully.');
    return back();
    }

    //update
    public function updatePage($id){
        $updatePage = Category::find($id);
        return view('admin.category.update', compact("updatePage"));
    }

    public function update(Request $request){
        $update = Category::find($request->id);
        $update->update([
            'name' => $request->CategoryName
        ]);

        Alert::success('Updated!', 'Category updated successfully.');
        return to_route('categoryPage');
    }


    //check validation for category
   private function checkValidation($request){
        $request->validate([
            'CategoryName' => 'required|unique:categories,name'. $request->id
        ],[
            'CategoryName.required' => 'အမျိုးအစားဖန်တီးမှု လိုအပ်သည်။',
            'CategoryName.unique' => 'အမျိုးအစားအမည်ကို ဖန်တီးထားပြီးဖြစ်သည်။'
        ]);
    }


}
