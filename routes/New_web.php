<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSectorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApproveProfileController;
use App\Http\Controllers\VisaApplicationController;
use App\Http\Controllers\ApproveVisaApplicationController;
use App\Http\Controllers\AuthAdmin\LoginController;
use App\Http\Controllers\GoogleChartController;
use App\Http\Controllers\GraphTableController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ApproveOssController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GraphController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\UserManageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('/dashboard');
    } else {
        if (Auth::check()) {
            return redirect('/home');
        } else {
            return view('auth.login');
        }
    }
});

//Admin routes
Route::get('/dash', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('/dashboard');
    } else {
            return view('authAdmin.login');
    }
});

 Route::post('/login/admin', [LoginController::class,'adminLogin'])->name('adminlogin');
 Route::get('/admin/logout', [LoginController::class,'logout'])->name('admin.logout');

//Admin
Route::get('/inbox', [AdminController::class, 'index'])->name('inbox')->middleware('adminrank');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('adminrank');;

//ApprovedForm
Route::get('/approvedform', [FormController::class, 'approvedForm'])->name('approvedform');
Route::get('/approvedformdetail/{id}', [FormController::class, 'showAppForm'])->name('showAppForm');

Route::get('/rejectedform', [FormController::class, 'rejectedForm'])->name('rejectedform');
Route::get('/rejectedformdetail/{id}', [FormController::class, 'showRejForm'])->name('showRejForm');

Route::get('/turnDownForm', [FormController::class, 'turnDownForm'])->name('turnDownForm');
Route::get('/turndownformdetail/{id}', [FormController::class, 'showturnDownForm'])->name('showturnDownForm');

Route::get('/inprocessform', [FormController::class, 'inProcessForm'])->name('inprocessform');
Route::get('/inprocessdetail/{id}', [FormController::class, 'showinProcessForm'])->name('showinProcessForm');

Route::get('/outboxform', [FormController::class, 'outBoxForm'])->name('outboxform');
// Route::get('/inprocessdetail/{id}', [FormController::class, 'showinProcessForm'])->name('showinProcessForm');;

//OSS
Route::get('/ossi/approve/{id}',[ApproveOssController::class,'ossiApprove'])->name('ossi.approve');
Route::get('/ossi/reject/{id}',[ApproveOssController::class,'ossiReject'])->name('ossi.reject');
Route::get('/ossl/approve/{id}',[ApproveOssController::class,'osslApprove'])->name('ossl.approve');

Route::group(['middleware' => ['superadmin']], function () {
	//AdminManagement
	Route::get('/admintable', [AdminController::class, 'adminTable'])->name('admintable');
	Route::get('/adminmanagement', [AdminController::class, 'showCreateForm'])->name('adminmanagement');
	Route::post('/adminmanagement/create', [AdminController::class, 'createAdmin'])->name('admin.create');
    Route::get('/adminmanagement/edit/{id}', [AdminController::class, 'showEditForm'])->name('admin.edit');
    Route::post('/adminmanagement/update/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update');
	
    //AdminSector
    Route::get('/adminsector', [AdminSectorController::class, 'index'])->name('adminsector');
    Route::get('/adminsector/{id}', [AdminSectorController::class, 'edit'])->name('adminsector.edit');
    Route::post('/adminsector/store/{id}', [AdminSectorController::class, 'store'])->name('adminsector.store');

    //Naitonality
    Route::get('/nationlity',[NationalityController::class, 'index'])->name('nationalityform');
    Route::post('/nationlitystore',[NationalityController::class, 'store'])->name('nationality.store');
    Route::get('/nationality_edit/{id}',[NationalityController::class, 'edit'])->name('nationality.edit');
    Route::get('/nationality_update/{id}',[NationalityController::class, 'update'])->name('nationality.update');

    //UserManagement
    Route::get('/usertable',[UserManageController::class, 'index'])->name('user.index');
    Route::get('/usertable_edit/{userid}',[UserManageController::class,'edit'])->name('user.edit');
    Route::post('/usertable_update/{userid}', [UserManageController::class, 'update'])->name('user.update');

    //VerifyUserEmail
    Route::get('/useremail',[UserManageController::class, 'verifyUserEmail'])->name('user.email');
    Route::get('/useremailverify/{id}',[UserManageController::class, 'verifyEmail'])->name('user.emailverify');

    Route::post('/deleteuser/{id}',[UserManageController::class, 'deleteUser'])->name('user.delete');
});

//AdminChangePassword
Route::get('change-adminpassword', [AdminController::class, 'changePasswordForm']);
Route::post('change-adminpassword', [AdminController::class, 'changepasswordStore'])->name('change.adminpassword');

//NoteSheet
Route::get('/notesheet', [AdminController::class, 'noteSheet'])->name('notesheet');

//ApproveVisaApplication
Route::get('/visadetail', [ApproveVisaApplicationController::class, 'index'])->name('visadetail');
Route::get('/visadetail/{id}',[ApproveVisaApplicationController::class,'show'])->name('visa.show');
Route::post('/visadetail/send',[ApproveVisaApplicationController::class,'send'])->name('visa.send');
Route::post('/visadetail/approve',[ApproveVisaApplicationController::class,'approve'])->name('visa.approve');
Route::post('/visadetail/reject',[ApproveVisaApplicationController::class,'reject'])->name('visa.reject');
Route::post('/visadetail/turnDown',[ApproveVisaApplicationController::class,'turnDown'])->name('visa.turnDown');
Route::get('/visadetail/attach/{id}',[ApproveVisaApplicationController::class,'visa_detail_attach'])->name('visa_detail_attach');
Route::get('/foreign_technician/{id}',[ApproveVisaApplicationController::class,'foreignTech'])->name('foreignTech');
//Ajax
Route::post('toname',[ApproveVisaApplicationController::class,'toname']);

Route::get('/approveprofile', [ApproveProfileController::class, 'index'])->name('approveprofile');
Route::get('/approveprofile/detail/{profile_id}', [ApproveProfileController::class, 'detail'])->name('approveprofile.detail');
Route::get('/approveprofile/{profile_id}', [ApproveProfileController::class, 'acceptProfile'])->name('approveprofile.accept');
Route::post('/denyprofile/{profile_id}', [ApproveProfileController::class, 'destroy'])->name('profile.deny');

//SingUp
Route::get('/passwordResetSuccess', [ProfileController::class, 'passwordReset']);
Route::get('/signup', [ProfileController::class, 'index'])->name('signup');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/editprofile', [ProfileController::class, 'edit'])->name('editprofile');
Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/deleteincrease/{id}', [ProfileController::class, 'deleteIncreased'])->name('profile.deleteincrease');

//Auth
Auth::routes(['verify' => true]);

//Logout
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'], function () {
    return abort(404);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Route::get('/applyform', [App\Http\Controllers\VisaApplicationController::class, 'index'])->name('applyform');
Route::get('/applyform', [VisaApplicationController::class, 'index'])->name('applyform');


// Route::post('/applyform/submit', [App\Http\Controllers\VisaApplicationController::class, 'store'])->name('applyform.store');
Route::post('/applyform/submit', [VisaApplicationController::class, 'store'])->name('applyform.store');


// Route::get('/applyform/{id}', [App\Http\Controllers\VisaApplicationController::class, 'edit'])->name('applyform.id');
Route::get('/applyform/{id}', [VisaApplicationController::class, 'edit'])->name('applyform.id');

// Route::post('/applyform/update/{id}', [App\Http\Controllers\VisaApplicationController::class, 'update'])->name('applyform.update');
Route::post('/applyform/update/{id}', [VisaApplicationController::class, 'update'])->name('applyform.update');

//Foreign Technician
Route::get('/foreign_technician_create',[App\Http\Controllers\ForeignTechicianController::class,'create'])->name('FT.create');
Route::post('/itemcreate',[App\Http\Controllers\ForeignTechicianController::class,'store'])->name('FT.store');
Route::get('/foreign_technician_show',[App\Http\Controllers\ForeignTechicianController::class,'index'])->name('FT.show');
Route::get('/foreign/{foreign_id}',[App\Http\Controllers\ForeignTechicianController::class,'edit'])->name('FT.edit');
Route::get('/foreignupdate/{foreign_id}',[App\Http\Controllers\ForeignTechicianController::class,'update'])->name('FT.update');
Route::post('/foreigndelete/{foreign_id}',[App\Http\Controllers\ForeignTechicianController::class,'delete'])->name('FT.delete');


//UserGuide
Route::get('/downloadMyanmar',[App\Http\Controllers\GuideAttachController::class, 'downloadMyanmar'])->name('download.Myanmar');
Route::get('/downloadEnglish',[App\Http\Controllers\GuideAttachController::class, 'downloadEnglish'])->name('download.English');

//PDF
Route::get('/print/pdf/{id}', [FormController::class, 'showPrintForm'])->name('print.pdf');


    
Route::get('/reportForm',[App\Http\Controllers\AdminController::class,'reportForm'])->name('report.Form');

Route::get('/report/export',[App\Http\Controllers\ReportController::class,'reportExport'])->name('report.export');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return("success clear");
});





//Graph
Route::get('/graphForm', [GoogleChartController::class, 'googleChart'])->name('GraphForm');

//Graph_Table
Route::get('/gerphtableshow',[GraphTableController::class,'graphtable'])->name('GraphTable');





















