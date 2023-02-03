<?php

namespace App\Http\Controllers;

use App\Models\Dependant;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DependantController extends Controller
{
    //---*Hein*---//

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(){
        $playlists = Dependant::where('profile_id',Auth::user()->profile->id)->get();
        return view('dependants', compact('playlists'));
    }

    public function create(){
        return view('dependent_create');
    }

    public function store(Request $request){
        // dd($request->all());
        $dependants = Dependant::create($request->all());

        if ($request->hasfile('image')) {
            $profile = $request->file('image');
            $upload_path =public_path().'/dependants_photos/';
            $name = $dependants->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/dependants_photos/'.$name;
        }else{
            $att= " ";
        }

        if ($request->hasfile('formc_file_name')) {
            $form_c = $request->file('formc_file_name');
            $upload_path =public_path().'/form_c_attach_dependants/';
            $name = $dependants->id.time().'.'.$form_c->getClientOriginalExtension();
            $form_c->move($upload_path,$name);
            $form_c_filename = '/form_c_attach_dependants/'.$name;
        }else{
            $form_c_filename = "";
        }

        $dependants->update(['status'=>1]);
        $dependants->update(['image'=>$att]);
        $dependants->update(['formc_file_name'=>$form_c_filename]);

        Toastr::success('Foreign Techician created!');
        return redirect()->route('DP.show');
    }

    public function list(Request $request){
        if($request->status == 1){
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('Status', 1)->latest()->get();
        }else if($request->status == 2){
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('Status', 2)->latest()->get();
        }else if($request->status == 3){
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('Status', 3)->latest()->get();
        }else{
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('Status', 0)->latest()->get();
        }
        return response()->json($dependants);
    }

    public function edit($id)
    {
        $playlist = Dependant::Find($id);
        // dd($playlist);
        return view('dependant_edit',compact('playlist'));
    }

    public function update($id,Request $request)
    {
    	// dd($request->all());

        $dependants = Dependant::Find($id);
        if($request->file('image')) {
            $old_image = $dependants->image;
            if(File::exists($old_image)) {
                File::delete($old_image);
            }

            $profile = $request->file('image');
            $upload_path =public_path().'/dependants_photos/';
            $name = $dependants->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/dependants_photos/'.$name;

        }else {
            unset($request->image);
        }


        if($request->file('formc_file_name')) {
            $form_c_old = $dependants->form_c_filename;
            if(File::exists($form_c_old)) {
                File::delete($form_c_old);
            }

            $form_c = $request->file('formc_file_name');
            $upload_path =public_path().'/form_c_attach_dependants/';
            $name = $dependants->id.time().'.'.$form_c->getClientOriginalExtension();
            $form_c->move($upload_path,$name);
            $form_c_filename = '/form_c_attach_dependants/'.$name;
        }else {
            unset($request->form_c_filename);
        }


        $dependants->update($request->all());
        if (!is_null($request->image)) {
            $dependants->update(['image'=>$att]);
        }else{
            $dependants->update(['image'=>$dependants->iamge]);
        }

        if (!is_null($request->formc_file_name)) {
            $dependants->update(['formc_file_name'=>$form_c_filename]);
        }else{
            $dependants->update(['formc_file_name'=>$dependants->formc_file_name]);
        }

        Toastr::success('Foreign Techician updated!');

        return redirect()->route('DP.show'); 
    }

    public function delete($id)
    {
        $playlist = Dependant::findOrFail($id);
        // dd($playlist);
        $file = public_path() . $playlist->image;
        unlink($file);
        
        $playlist->delete();

        Toastr::success('Dependant deleted!');

        return redirect()->route('DP.show');
    }

    public function search(Request $request)
    {
        if($request->status == 1){
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('status', 1)
                            ->where('name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else if($request->status == 2){
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('status', 2)
                            ->where('name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else if($request->status == 3){
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('status', 3)
                            ->where('name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else{
            $dependants = Dependant::where('profile_id', $request->profile_id)
                            ->where('status', 0)
                            ->where('name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }
        return response()->json($dependants);
        // return response()->json([$request->profile_id, $request->search, $request->status]);
    }
}
