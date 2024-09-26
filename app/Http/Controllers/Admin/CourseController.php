<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Traits\FirebaseStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CourseController extends Controller
{
    use FirebaseStorageTrait;
    
    public function index(){
        $course = Course::orderBy('id', 'desc')->get();
        return view('admin.course.index', compact('course'));
    }


    public function create(){
        $categories  = Category::orderBy('id', 'desc')->get();
        return view('admin.course.create', compact('categories'));
    }

    public function store(Request $request){
       
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'string'],
            'category_id' => ['required', 'string'],
            'price' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
        
        

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput(); 
        }

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $imageUrl = $this->uploadFileToFirebase($request->file('image'), 'images/courses/');
        }

        try{
            Course::create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->title),
                'description' =>$request->description,
                'duration' => $request->duration,
                'status' => $request->status,
                'author' => $request->author,
                'level' => $request->level,
                'price' => $request->price,
                'category_id'=> $request->category_id,
                'image'=>$imageUrl,
            ]);
            return redirect()->route('admin.course.index')->with('success', 'Course created successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something went worry');
        }

    }

    public function edit($id){
        $course = Course::find($id);
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.course.edit', compact('course','categories'));
    }


    public function update(Request $request, $id){
        $course = Course::find($id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $manager->read($image);
            $img =  $file->resize(1200, 800);
            $img->toJpeg(80)->save(public_path('upload/courses/' . $filename));
            $course->image = $filename;
        }

        // dd($request->all());

        $course->update([ 
            'title' => $request->input('title'),
            'slug' => Str::slug($request->title),
            'description' =>$request->description,
            'duration' => $request->duration,
            'status' => $request->status,
            'author' => $request->author,
            'level' => $request->level,
            'price' => $request->price,
            'category_id'=> $request->category_id,
            // 'image' => $course->image,
        ]);

        $course->save();

        return redirect()->route('admin.course.index')->with('success', 'Course updated successfully');
    }


    public function delete($id){
        $course =  Course::findOrFail($id);
        $course->delete();
        return back()->with('success', 'Course deleted successfully');
    }
}
