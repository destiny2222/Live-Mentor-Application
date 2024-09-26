<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plugin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PluginController extends Controller
{
    public function index(){
        $plugins = Plugin::all();
        return view('admin.plugin.index', compact('plugins'));
    }

    public function create(){
        return view('admin.plugin.create');
    }
    
    public function store(Request $request){
        // Implement plugin creation logic here
        $validator = Validator::make($request->all(), [
            'client_email' => ['required', 'string'],
            'private_key_id' => ['required', 'string'],
            'project_id' => ['required', 'string'],
            'client_x509_cert_url' => ['required', 'string'],
            'private_key' => ['required', 'string'],
            'client_id' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput(); 
        }

        // check if files before Saving or update plugin data to the database or storage
        
        $plugin = Plugin::updateOrCreate([
            'client_id' => $request->client_id,
            'private_key_id'=> $request->private_key_id,
            'project_id' => $request->project_id,
            'client_x509_cert_url' => $request->client_x509_cert_url,
            'private_key'=>$request->private_key,
            'client_email'=> $request->client_email
        ]);
        $plugin->save();
        // Redirect to plugin index page with success message
        return redirect()->route('admin.plugin.index')->with('success', 'Plugin created successfully');
    }

    public function edit($id){
        // Implement plugin edit logic here
        $plugin = Plugin::find($id);
        if($plugin){
            return view('admin.plugin.edit', compact('plugin'));
        }
        return redirect()->route('admin.plugin.index')->with('error', 'Plugin not found');
    }

    public function update(Request $request, $id){
        // Implement plugin update logic here
        $validator = Validator::make($request->all(), [
            'client_email' => ['required','string'],
            'private_key_id' => ['required','string'],
            'project_id' => ['required','string'],
            'private_key' => ['required','string'],
            'client_id' => ['required','string'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput(); 
        }
        
        $plugin = Plugin::find($id);
        if($plugin){
            $plugin->client_email = $request->client_email;
            $plugin->private_key_id = $request->private_key_id;
            $plugin->project_id = $request->project_id;
            $plugin->private_key = $request->private_key;
            $plugin->client_id = $request->client_id;
            $plugin->save();
            // Redirect to plugin index page with success message
            return redirect()->route('admin.plugin.index')->with('success', 'Plugin updated successfully');
        }
        return redirect()->route('admin.plugin.index')->with('error', 'Plugin not found');
    }
    
    public function destroy($id){
        // Implement plugin deletion logic here
        $plugin = Plugin::find($id);
        if($plugin){
            $plugin->delete();
            // Redirect to plugin index page with success message
            return redirect()->route('admin.plugin.index')->with('success', 'Plugin deleted successfully');
        }
        return redirect()->route('admin.plugin.index')->with('error', 'Plugin not found');
    }
}
