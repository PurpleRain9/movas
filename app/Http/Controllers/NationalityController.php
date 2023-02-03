<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nationality; 
use Brian2694\Toastr\Facades\Toastr;

class NationalityController extends Controller
{
    //
      public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','adminrank']);
    }
    
    //
    public function index(Request $request)
    {
        $search = $request->search;

        if (!is_null($search)) {
            $nations = Nationality::where('NationalityName', 'like', '%'.$search.'%')->get();
        }else{
            $nations = Nationality::all();
        }
        
        return view('admin.nationality.index',compact('nations'));
    }

     public function store(Request $request)
    {
         $request->validate([
            'NationalityName' => ['required','unique:nationalities'],
            
        ]);

        $nation = Nationality::create([
            'NationalityName'=>$request['NationalityName'],
        ]);

        Toastr::success('Nationality added!');

        return redirect()->route('nationalityform');
    }

     public function edit($id)
    {
        $nation = Nationality::Find($id);
        return view('admin.nationality.edit',compact('nation'));
    }

    public function update($id)
    {
        $nation = Nationality::Find($id);
        $nation->update(['NationalityName'=>request('NationalityName')]);
       	
       	Toastr::success('Nationality updated!');

        return redirect()->route('nationalityform'); 
    }

    


}
