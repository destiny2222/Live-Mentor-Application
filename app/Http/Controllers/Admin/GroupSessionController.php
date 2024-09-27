<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mentor;
use App\Models\GroupSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupSessionController extends Controller
{
    public function index(){
        $groups = GroupSession::orderBy('id', 'desc')->get();
        return view('admin.group.index', compact('groups'));
    }


    public function create(){
        return view(view: 'admin.group.create');
    }

    public function store(Request $request){
        
    }

    public function show($id){
        $group = GroupSession::findOrFail($id);
        return view('admin.group.show', compact('group'));

    }

    public function update(Request $request, $id){
        $group = GroupSession::findOrFail($id);
        $group->update($request->all());
        return redirect()->route('admin.group.session.index')->with('success', 'Updated successfully');
    }

    public function delete($id){
        try{
            $group = GroupSession::findOrFail($id);
            $group->delete();
            return back()->with('error', 'Deleted successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went worry');
        }
    }
}
