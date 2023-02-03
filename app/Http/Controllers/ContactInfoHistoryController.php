<?php

namespace App\Http\Controllers;

use App\Models\ContactInfoHistory;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactInfoHistoryController extends Controller
{
    public function index()
    {
        return view('contactInfoHistory');
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        
        $contact_info_history = new ContactInfoHistory();
        $contact_info_history->user_id = $user->id;
        $contact_info_history->old_name = $user->name;
        $contact_info_history->old_phone_number = $user->phone_no;
        $contact_info_history->save();


        User::find(auth()->user()->id)->update([
            'name' => $request->name ? $request->name : $user->name,
            'phone_no' => $request->phone_no ? $request->phone_no : $user->phone_no
        ]);

        Toastr::success('User info changed successfully!');

        return redirect()->route('home');


    }
}
