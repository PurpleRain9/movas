<?php

namespace App\Http\Controllers;

use App\Exports\ForeignTechExport;
use Illuminate\Http\Request;
use App\Models\ForeignTechician;
use App\Models\Profile;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class ForeignTechicianController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function list(Request $request)
    {
        if($request->status == 1){
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 1)->latest()->get();
        }else if($request->status == 2){
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 2)->latest()->get();
        }else if($request->status == 3){
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 3)->latest()->get();
        }else{
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 0)->latest()->get();
        }
        return response()->json($technicians);
    }

    public function search(Request $request)
    {
        if($request->status == 1){
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 1)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else if($request->status == 2){
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 2)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else if($request->status == 3){
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 3)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }else{
            $technicians = ForeignTechician::where('profile_id', $request->profile_id)
                            ->where('Status', 0)
                            ->where('Name', 'LIKE', '%'.$request->search.'%')->latest()->get();
        }
        return response()->json($technicians);
        // return response()->json([$request->profile_id, $request->search, $request->status]);
    }

    public function show(Request $request)
    {
        $technician = ForeignTechician::find($request->id);
        return response()->json($technician);
    }

    public function resignApply(Request $request, $id)
    {
        // dd($request->all(), $id);
        $foreign_technician = ForeignTechician::find($id);
        if($foreign_technician->first_apply_date){
            $foreign_technician->final_apply_date = Carbon::now()->toDateString();
        }else{
            $foreign_technician->first_apply_date = Carbon::now()->toDateString();
            $foreign_technician->final_apply_date = Carbon::now()->toDateString();
        }
        $foreign_technician->Status = 2;

        if($request->file('passport')){
            $passport = $request->file('passport');
            $passport_file_path = date('YmdHis')."-".strtolower(str_replace(' ', '', $request->file('passport')->getClientOriginalName()));
            $destinationPath = 'foreign_tech_photo/foreign_passports/';
            $passport->move($destinationPath, $passport_file_path);
            $foreign_technician->passport_filename = $passport_file_path;
        }

        if($request->file('mic_permit')){
            $mic_permit = $request->file('mic_permit');
            $mic_permit_file_path = date('YmdHis')."-".strtolower(str_replace(' ', '', $request->file('mic_permit')->getClientOriginalName()));
            $destinationPath = 'foreign_tech_photo/foreign_mic_permits/';
            $mic_permit->move($destinationPath, $mic_permit_file_path);
            $foreign_technician->mic_permit_filename = $mic_permit_file_path;
        }

        if($request->file('mic_copy_resigned_letter')){
            $mic_copy_resigned_letter = $request->file('mic_copy_resigned_letter');
            $mic_copy_resigned_letter_file_path = date('Y-m-d-H-i-s')."-".strtolower(str_replace(' ', '', $request->file('mic_copy_resigned_letter')->getClientOriginalName()));
            $destinationPath = 'foreign_tech_photo/foreign_mic_copy_resigned_letters/';
            $mic_copy_resigned_letter->move($destinationPath, $mic_copy_resigned_letter_file_path);
            $foreign_technician->mic_copy_resigned_letter_filename = $mic_copy_resigned_letter_file_path;
        }

        if($request->file('air_ticket')){
            $air_ticket = $request->file('air_ticket');
            $air_ticket_file_path = date('YmdHis')."-".strtolower(str_replace(' ', '', $request->file('air_ticket')->getClientOriginalName()));
            $destinationPath = 'foreign_tech_photo/foreign_air_tickets/';
            $air_ticket->move($destinationPath, $air_ticket_file_path);
            $foreign_technician->air_ticket_filename = $air_ticket_file_path;
        }

        $foreign_technician->update();

        Toastr::success('Resignation apply successfully!');

        return back();
    }

    public function index()
    {
        $playlists = ForeignTechician::where('profile_id',Auth::user()->profile->id)->get();
        return view('foreign_technician', compact('playlists'));
    }

    public function create()
    {
        return view('foreign_tech_create');
    }


    public function store(Request $request)
    {
    	// dd($request->all());
        $foreign_tech = ForeignTechician::create($request->all());

        if ($request->hasfile('Image')) {
            $profile = $request->file('Image');
            $upload_path =public_path().'/foreign_tech_photo/';
            $name = $foreign_tech->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/foreign_tech_photo/'.$name;
        }else{
            $att= "";
        }

        if ($request->hasfile('form_c_filename')) {
            $form_c = $request->file('form_c_filename');
            $upload_path =public_path().'/form_c_attach/';
            $name = $foreign_tech->id.time().'.'.$form_c->getClientOriginalExtension();
            $form_c->move($upload_path,$name);
            $form_c_filename = '/form_c_attach/'.$name;
        }else{
            $form_c_filename = "";
        }

        if ($request->hasfile('micApprovedFile')) {
            $mic_approved_letter = $request->file('micApprovedFile');
            $upload_path =public_path().'/micApprovedAtt/';
            $name = $foreign_tech->id.time().'.'.$mic_approved_letter->getClientOriginalExtension();
            $mic_approved_letter->move($upload_path,$name);
            $mic_approved_letterfile = '/micApprovedAtt/'.$name;
        }else{
            $mic_approved_letterfile= '';
        }

        if($request->hasFile('larbourCard')) {
            $labour_card = $request->file('larbourCard');
            $upload_path = public_path().'/labourCard/';
            $name = $foreign_tech->id.time().'.'.$labour_card->getClientOriginalExtension();
            $labour_card->move($upload_path,$name);
            $labour_card_file = '/labourCard/'.$name;
        }else{
            $labour_card_file = "";
        }

        $foreign_tech->update(['Status'=>1]);
        $foreign_tech->update(['Image'=>$att]);
        $foreign_tech->update(['form_c_filename'=>$form_c_filename]);
        $foreign_tech->update(['mic_aprroved_letter' => $mic_approved_letterfile]);
        $foreign_tech->update(['labour_card' => $labour_card_file]);

        Toastr::success('Foreign Techician created!');

        return redirect()->route('FT.show');

    }

    public function edit($id)
    {
        $playlist = ForeignTechician::Find($id);
        return view('foreign_tech_edit',compact('playlist'));
    }

    public function update($id,Request $request)
    {
    	// dd($request->all());

        $foreign_tech = ForeignTechician::Find($id);
        if($request->file('Image')) {
            $old_image = $foreign_tech->Image;
            if(File::exists($old_image)) {
                File::delete($old_image);
            }

            $profile = $request->file('Image');
            $upload_path =public_path().'/foreign_tech_photo/';
            $name = $foreign_tech->id.time().'.'.$profile->getClientOriginalExtension();
            $profile->move($upload_path,$name);
            $att = '/foreign_tech_photo/'.$name;

        }else {
            unset($request->Image);
        }


        if($request->file('form_c_filename')) {
            $form_c_old = $foreign_tech->form_c_filename;
            if(File::exists($form_c_old)) {
                File::delete($form_c_old);
            }

            $form_c = $request->file('form_c_filename');
            $upload_path =public_path().'/form_c_attach/';
            $name = $foreign_tech->id.time().'.'.$form_c->getClientOriginalExtension();
            $form_c->move($upload_path,$name);
            $form_c_filename = '/form_c_attach/'.$name;
        }else {
            unset($request->form_c_filename);
        }

        // Mic approved letter
        if($request->file('micApprovedFile')) {
            $form_c_old = $foreign_tech->mic_aprroved_letter;
            if(File::exists($form_c_old)) {
                File::delete($form_c_old);
            }

            $mic_approved = $request->file('micApprovedFile');
            $upload_path =public_path().'/micApprovedAtt/';
            $name = $foreign_tech->id.time().'.'.$mic_approved->getClientOriginalExtension();
            $mic_approved->move($upload_path,$name);
            $mic_approved_file = '/micApprovedAtt/'.$name;
        }else {
            unset($request->micApprovedFile);
        }

        // Labour Card
        if($request->file('larbourCard')) {
            $form_c_old = $foreign_tech->labour_card;
            if(File::exists($form_c_old)) {
                File::delete($form_c_old);
            }

            $labour_card = $request->file('larbourCard');
            $upload_path =public_path().'/labourCard/';
            $name = $foreign_tech->id.time().'.'.$labour_card->getClientOriginalExtension();
            $labour_card->move($upload_path,$name);
            $larbour_card_file = '/labourCard/'.$name;
        }else {
            unset($request->larbourCard);
        }

        $foreign_tech->update($request->all());
        if (!is_null($request->Image)) {
            $foreign_tech->update(['Image'=>$att]);
        }else{
            $foreign_tech->update(['Image'=>$foreign_tech->Image]);
        }

        if (!is_null($request->form_c_filename)) {
            $foreign_tech->update(['form_c_filename'=>$form_c_filename]);
        }else{
            $foreign_tech->update(['form_c_filename'=>$foreign_tech->form_c_filename]);
        }
        if (!is_null($request->micApprovedFile)) {
            $foreign_tech->update(['mic_aprroved_letter'=>$mic_approved_file]);
        }else {
            $foreign_tech->update(['mic_aprroved_letter'=>$foreign_tech->mic_aprroved_letter]);
        }

        if (!is_null($request->larbourCard)) {
            $foreign_tech->update(['labour_card'=>$larbour_card_file]);
        }else {
            $foreign_tech->update(['labour_card'=>$foreign_tech->labour_card]);
        }

        Toastr::success('Foreign Techician updated!');

        return redirect()->route('FT.show'); 
    }

    public function delete($id)
    {
        $playlist = ForeignTechician::findOrFail($id);
        // dd($playlist);
        $file = public_path() . $playlist->Image;
        unlink($file);
        
        $playlist->delete();

        Toastr::success('Foreign Techician deleted!');

        return redirect()->route('FT.show');
    }


}
