<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::orderBy('id','desc')->get();
        return view('admin.category.index', compact('category'));
    }


    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'image'=>['required','string'],
        ]);
        try{
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->image = $request->image;
            $category->save();
            return redirect()->route('admin.category.index')->with('success','Category created successfully');
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
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->image = $request->image;
            $category->save();
            return redirect()->route('admin.category.index')->with('success','Category updated successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.category.index')->with('error','Category not updated');
        }
    }

    public function delete(Request $request){
        try{
            $category = Category::find($request->id);
            $category->delete();
            return redirect()->route('admin.category.index')->with('success','Category deleted successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.category.index')->with('error','Category not deleted');
        }
    }
}
