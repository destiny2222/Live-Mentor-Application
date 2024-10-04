<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategory = SubCategory::orderBy('id','desc')->get();
        return view('admin.subcategory.index', compact('subcategory'));
    }


    public function edit($id){
        $subcategory = SubCategory::find($id);
        return view('admin.category.edit',compact('subcategory'));
    }

    public function create(){
        $category = Category::all();
        return view('admin.subcategory.create', compact('category'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'image'=>['required','string'],
        ]);
        try{
            $subcategory = new SubCategory();
            $subcategory->name = $request->name;
            $subcategory->slug = Str::slug($request->name);
            $subcategory->image = $request->image;
            $subcategory->color = $request->color;
            $subcategory->save();
            return redirect()->route('admin.subcategory.index')->with('success','Category created successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('error','Something went wrong');
        }
    
    }


    public function update(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'image'=>['required','string'],
        ]);
        try{
            $subcategory = SubCategory::find($request->id);
            $subcategory->name = $request->name;
            $subcategory->slug = Str::slug($request->name);
            $subcategory->image = $request->image;
            $subcategory->color = $request->color;
            $subcategory->save();
            return redirect()->route('admin.subcategory.index')->with('success','Category updated successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.subcategory.index')->with('error','Category not updated');
        }
    }

    public function delete(Request $request){
        try{
            $subcategory = SubCategory::find($request->id);
            $subcategory->delete();
            return redirect()->route('admin.subcategory.index')->with('success','Category deleted successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.subcategory.index')->with('error','Category not deleted');
        }
    }
}
