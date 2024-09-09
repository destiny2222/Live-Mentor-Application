<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchEngine(Request $request)
    {
        $search = $request->input('search');
    
        if (!$search) {
            return back()->with('error', 'Your request was not found.');
        }
    
        $courses = Course::where('title', '!=', Null)
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->paginate(6);
    
        return view('frontend.course', compact('courses'));
    }


    
}
