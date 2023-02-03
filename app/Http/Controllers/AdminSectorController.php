<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Sector;
use Brian2694\Toastr\Facades\Toastr;

class AdminSectorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','superadmin']);
    }

    public function index()
    {
    	$admins = Admin::where('rank_id','=',1)->get();
    	return view('admin.admin_sector.index',compact('admins'));
    }

    public function edit($id)
    {
    	$admin = Admin::findOrFail($id);
    	$sectors = Sector::all();
    	// dd($admin);
    	return view('admin.admin_sector.edit',compact('admin','sectors'));
    }

    public function store($id,Request $request)
    {
    	// dd($request);
    	$admin = Admin::findOrFail($id);
    	$admin->sectors()->detach();

    	$sector_id = $request->sector_id;

    	if (!is_null($sector_id)) {
	    	for ($i = 0; $i < count($sector_id); $i++) {
	    		$admin->sectors()->attach([$sector_id[$i]]);
	    	}
    	}

    	Toastr::success('You have saved the datas!');

    	return redirect()->route('adminsector');
    }
}
