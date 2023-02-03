<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\ForeignTechician;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DirectorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index()
    {        
        $playlists = Director::where('profile_id',Auth::user()->profile->id)->get();
        return view('director', compact('playlists'));
    }
    public function create()
    {
        return view('director_create');
    }
    public function store(Request $request)
    {
    	// dd($request->all());
        $director = Director::create($request->all());

        if ($request->hasfile('image')) {
            $profile = $request->file('image');
            $upload_path =public_path().'/director_photo/';
            $name = $director->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/director_photo/'.$name;
        }else{
            $att= "";
        }

        // /form_c_attach_director/

        if ($request->hasfile('formc_file_name')) {
            $profile = $request->file('formc_file_name');
            $upload_path = public_path().'/form_c_attach_director/';
            $name = $director->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $formc_filename = '/form_c_attach_director/'.$name;
            // dd($formc_filename);
        }else{
            $formc_filename= "";
        }

        
        if($request->hasFile('extract_filename')) {
            $extractForm = $request->file('extract_filename');
            $upload_path = public_path().'/extractForm/';
            $name = $director->id.time().'.'.$extractForm->getClientOriginalExtension();
            $extractForm->move($upload_path,$name);
            $extractForm_file = '/extractForm/'.$name;
        }else{
            $extractForm_file = "";
        }

        $director->update(['status'=>1]);
        $director->update(['image'=>$att]);
        $director->update(['formc_file_name'=>$formc_filename]);
        $director->update(['extract_filename' => $extractForm_file]);

        Toastr::success('Director created!');
        return redirect()->route('director.show');

    }
    public function list(Request $request)
    {
        if($request->status == 1){
            $directors_list = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 1)->latest()->get();
        }else if($request->status == 2){
            $directors_list = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 2)->latest()->get();
        }else if($request->status == 3){
            $directors_list = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 3)->latest()->get();
        }else{
            $directors_list = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 0)->latest()->get();
        }
        return response()->json($directors_list);
    }
    public function edit($id)
    {
        $playlist = Director::Find($id);
        return view('director_edit',compact('playlist'));
    }
    public function update($id,Request $request)
    {
    	// dd($request->all());

        $director = Director::Find($id);
        if($request->file('image')) {
            $old_image = $director->image;
            if(File::exists($old_image)) {
                File::delete($old_image);
            }
            $profile = $request->file('image');
            $upload_path =public_path().'/director_photo/';
            $name = $director->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/director_photo/'.$name;

        }else {
            unset($request->image);
        }

        if($request->file('formc_filename')) {
            $form_c_old = $director->formc_filename;
            if(File::exists($form_c_old)) {
                File::delete($form_c_old);
            }
            $form_c = $request->file('formc_filename');
            $upload_path =public_path().'/form_c_attach_director/';
            $name = $director->id.time().'.'.$form_c->getClientOriginalExtension();
            $form_c->move($upload_path,$name);
            $formc_filename = '/form_c_attach_director/'.$name;
        }else {
            unset($request->formc_filename);
        }

        // Extract Form
        if($request->file('extract_filename')) {
            $extractform_old = $director->extract_filename;
            if(File::exists($extractform_old)) {
                File::delete($extractform_old);
            }
            $extract_filename = $request->file('extract_filename');
            $upload_path =public_path().'/extract_filename/';
            $name = $director->id.time().'.'.$extract_filename->getClientOriginalExtension();
            $extract_filename->move($upload_path,$name);
            $extract_filename = '/extract_filename/'.$name;
        }else {
            unset($request->extract_filename);
        }

        $director->update($request->all());

        if (!is_null($request->image)) {
            $director->update(['image'=>$att]);
        }else{
            $director->update(['image'=>$director->image]);
        }

        if (!is_null($request->formc_filename)) {
            $director->update(['formc_file_name'=>$formc_filename]);
        }else{
            $director->update(['formc_file_name'=>$director->formc_filename]);
        }

        if (!is_null($request->extract_filename)) {
            $director->update(['extract_filename'=>$extract_filename]);
        }else {
            $director->update(['extract_filename'=>$director->extract_filename]);
        }

        Toastr::success('Director updated!');

        return redirect()->route('director.show');
    }
    public function delete($id)
    {
        $playlist = Director::findOrFail($id);
        // dd($playlist);
        $file = public_path() . $playlist->image;
        unlink($file);
        
        $playlist->delete();

        Toastr::success('Director deleted!');

        return redirect()->route('director.show');
    }
    public function search(Request $request)
    {
        if($request->status == 1){
            $directors = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 1)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else if($request->status == 2){
            $directors = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 2)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else if($request->status == 3){
            $directors = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 3)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else{
            $directors = Director::where('profile_id', $request->profile_id)
                            ->where('Status', 0)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }
        return response()->json($directors);
        // return response()->json([$request->profile_id, $request->search, $request->status]);
    }
}
