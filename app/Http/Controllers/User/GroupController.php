<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GroupSession;
use App\Traits\FirebaseStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    use FirebaseStorageTrait;
    
    public function index()
    {
        $groups = GroupSession::where('user_id', Auth::user()->id)->get();
        return view('user.group.index', compact('groups'));
    }

    public function create(){
        return view('user.group.create');
    }

// '',
//         '',
//         '',
//         '',
//         '',
//         '',
//         '',
//         'max_participants',
//         'price',
//         'status',
//         '',
//         'user_id'
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'start_time' => ['required', 'time'],
            'end_time' => ['required','time'],
            'price' => ['required','string'],
            'location' => ['required','string'],
            'topic_expertise'=>['required','string'],
            'interest_areas'=>['required','string'],
            'image'=>['required','image', 'mimes:jpeg,png,jpg,gif|max:2048'],
        ]);

        $image_file = $this->uploadFileToFirebase($request->file('image'), 'profile/');
    }
}
