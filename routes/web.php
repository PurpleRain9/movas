<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSectorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApproveProfileController;
use App\Http\Controllers\VisaApplicationController;
use App\Http\Controllers\ApproveVisaApplicationController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ApproveOssController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactInfoHistoryController;
use App\Http\Controllers\DependantController;
use App\Http\Controllers\ForeignTechicianController;
use App\Http\Controllers\GoogleChartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileManageController;
use App\Models\Dependant;
use App\Models\Profile;
use Illuminate\Routing\Route as RoutingRoute;

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
// Route::get('/dash', [App\Http\Controllers\AuthAdmin\LoginController::class,'showAdminLoginForm'])->name('admin.login');
Route::get('/dash', function () {
    if (Auth::guard('admin')->check()) {
        return redirect('/dashboard');
    } else {
            return view('authAdmin.login');
    }
});

 Route::post('/login/admin', [App\Http\Controllers\AuthAdmin\LoginController::class,'adminLogin'])->name('adminlogin');
 Route::get('/admin/logout', [App\Http\Controllers\AuthAdmin\LoginController::class,'logout'])->name('admin.logout');

//Admin
Route::get('/inbox', [AdminController::class, 'index'])->name('inbox')->middleware('adminrank');

Route::get('/newCase', [AdminController::class, 'newCase'])->name('newCase')->middleware('adminrank');

Route::get('/applyCase', [AdminController::class, 'applyCase'])->name('applyCase')->middleware('adminrank');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('adminrank');


Route::get('/rejectHistory', [AdminController::class, 'rejectHistory'])->name('rejectHistory')->middleware('adminrank');

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

Route::get('/ossi/eachapprove/{id}',[ApproveOssController::class,'ossiEachApprove'])->name('ossi.eachapprove');
Route::get('/ossl/eachapprove/{id}',[ApproveOssController::class,'osslEachApprove'])->name('ossl.eachapprove');

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
    Route::get('/nationlity',[App\Http\Controllers\NationalityController::class, 'index'])->name('nationalityform');
    Route::post('/nationlitystore',[App\Http\Controllers\NationalityController::class, 'store'])->name('nationality.store');
    Route::get('/nationality_edit/{id}',[App\Http\Controllers\NationalityController::class, 'edit'])->name('nationality.edit');
    Route::get('/nationality_update/{id}',[App\Http\Controllers\NationalityController::class, 'update'])->name('nationality.update');

    //VerifyUserEmail
    Route::get('/useremail',[App\Http\Controllers\UserManageController::class, 'verifyUserEmail'])->name('user.email');
    Route::get('/useremailverify/{id}',[App\Http\Controllers\UserManageController::class, 'verifyEmail'])->name('user.emailverify');
});

//UserManagement
Route::get('/usertable',[App\Http\Controllers\UserManageController::class, 'index'])->name('user.index');
Route::get('/usertable_edit/{userid}',[App\Http\Controllers\UserManageController::class,'edit'])->name('user.edit');
Route::post('/usertable_update/{userid}', [App\Http\Controllers\UserManageController::class, 'update'])->name('user.update');
Route::post('/deleteuser/{id}',[App\Http\Controllers\UserManageController::class, 'deleteUser'])->name('user.delete');
Route::get('/deletedusers',[App\Http\Controllers\UserManageController::class, 'showDeleted'])->name('deleted.showusers');

// ProfileManagement
Route::get('/profiletable', [ProfileManageController::class, 'index'])->name('profile.index');
Route::get('/deleteProfile/{id}', [ProfileManageController::class, 'deleteProfile'])->name('deleteProfile');
Route::get('/profilesdeleted',[ProfileManageController::class, 'showDeleted'])->name('deleted.showprofiles');

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
Route::get('/profileList',[ApproveVisaApplicationController::class,'profile'])->name('profileList');
Route::get('/profileShow/{id}',[ApproveVisaApplicationController::class,'profileShow'])->name('profileShow');
Route::get('/directors_only/{id}',[ApproveVisaApplicationController::class, 'directors'])->name('directorsOnly');
Route::get('/dependants_only/{id}',[ApproveVisaApplicationController::class, 'dependants'])->name('dependantsOnly');

Route::get('/deleteremark/{id}',[ApproveVisaApplicationController::class,'deleteRemark'])->name('deleteRemark');
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

Route::get('/checkTwoMonths', [VisaApplicationController::class, 'checkTwoMonths'])->name('checkTwoMonths');
Route::get('/checkLabourType', [VisaApplicationController::class, 'checkLabourType'])->name('checkLabourType');

//Auth
Auth::routes([]);
//Logout
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'], function () {
    return abort(404);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('visa.detail');
Route::get('/home/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('visa.delete');
Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changePassword');
Route::POST('/changePasswordStore', [App\Http\Controllers\HomeController::class, 'changePasswordStore'])->name('changePasswordStore');

Route::get('/changeEmail', [HomeController::class, 'changeEmail'])->name('changeEmail');
Route::post('/changeEmailStore', [HomeController::class, 'changeEmailStore'])->name('changeEmailStore');


Route::get('/applyformopen', [App\Http\Controllers\VisaApplicationController::class, 'indexopen'])->name('applyform');
Route::post('/applyform/submit', [App\Http\Controllers\VisaApplicationController::class, 'store'])->name('applyform.store');

Route::get('/newApplyform/applicant', [App\Http\Controllers\SaveDraftController::class, 'newindexopen'])->name('newapplyform');
Route::get('/newapplyform', [App\Http\Controllers\SaveDraftController::class, 'index'])->name('applyformNew');
Route::post('/newApplyform/submit', [App\Http\Controllers\SaveDraftController::class, 'store'])->name('newApplyform.store');
Route::delete('/applicant/delete/{id}', [App\Http\Controllers\SaveDraftController::class, 'delete'])->name('newApplyform.delete');
Route::get('/applicant/edit/{id}/{editId}', [App\Http\Controllers\SaveDraftController::class, 'editApplicant'])->name('editApplicant');

Route::get('/applicant/delete/{id}/{deleteId}', [App\Http\Controllers\SaveDraftController::class, 'deleteAplicant'])->name('deleteAplicant');
Route::post('/applicationFormStore', [App\Http\Controllers\SaveDraftController::class, 'applicationFormStore'])->name('applicationFormStore');
Route::get('/applyFormReject/{id}', [App\Http\Controllers\SaveDraftController::class, 'applyFormReject'])->name('applyFormReject');
Route::post('/rejectApplicantUpdate', [App\Http\Controllers\SaveDraftController::class, 'rejectApplicantUpdate'])->name('rejectApplicantUpdate');



Route::get('/applyform/{id}', [App\Http\Controllers\VisaApplicationController::class, 'edit'])->name('applyform.id');
Route::post('/applyform/update/{id}', [App\Http\Controllers\VisaApplicationController::class, 'update'])->name('applyform.update');
Route::get('/deleteApplicant/{id}', [VisaApplicationController::class, 'delete'])->name('applicant.deny');



//UserGuide
Route::get('/downloadMyanmar',[App\Http\Controllers\GuideAttachController::class, 'downloadMyanmar'])->name('download.Myanmar');
Route::get('/downloadEnglish',[App\Http\Controllers\GuideAttachController::class, 'downloadEnglish'])->name('download.English');

//PDF
Route::get('/print/pdf/{id}', [FormController::class, 'showPrintForm'])->name('print.pdf');



//Report for DICA-PS Section
Route::get('/reportForm',[App\Http\Controllers\AdminController::class,'reportForm'])->name('report.Form');

Route::get('/report/export',[App\Http\Controllers\ReportController::class,'reportExport'])->name('report.export');

Route::get('/clear-cache', function() {
    \Artisan::call('dump-autoload');
    return("success clear");
});


Route::get('/graphForm',[App\Http\Controllers\GoogleChartController::class,'googleChart'])->name('GraphForm');


Route::get('/gerphtableshow',[App\Http\Controllers\GraphTableController::class,'graphtable'])->name('GraphTable');

Route::get('/backup',[App\Http\Controllers\ExportController::class,'backup'])->name('downloadSql');

// Company User Modal
Route::get('/getCompanyUserInfo', [ApproveVisaApplicationController::class, 'getCompanyUserInfo'])->name('getCompanyUserInfo');


// Contact Info History
Route::get('/contactInfoHistory', [ContactInfoHistoryController::class, 'index'])->name('contactInfoHistory.index');
Route::post('/contactInfoHistory/store', [ContactInfoHistoryController::class, 'store'])->name('contactInfoHistory.store');


//Foreign Technician
Route::get('/foreign_technician_create',[App\Http\Controllers\ForeignTechicianController::class,'create'])->name('FT.create');
Route::post('/itemcreate',[App\Http\Controllers\ForeignTechicianController::class,'store'])->name('FT.store');
Route::get('/foreign_technician_show',[App\Http\Controllers\ForeignTechicianController::class,'index'])->name('FT.show');
Route::get('/foreign/{foreign_id}',[App\Http\Controllers\ForeignTechicianController::class,'edit'])->name('FT.edit');
Route::post('/foreignupdate/{foreign_id}',[App\Http\Controllers\ForeignTechicianController::class,'update'])->name('FT.update');
Route::post('/foreigndelete/{foreign_id}',[App\Http\Controllers\ForeignTechicianController::class,'delete'])->name('FT.delete');

Route::get('/foreign_technicians', [ForeignTechicianController::class, 'list'])->name('FT.list');
Route::get('/foreign_technicians/show', [ForeignTechicianController::class, 'show'])->name('FT.modal');
Route::post('/foreign_technicians/{foreign_id}/resignApply', [ForeignTechicianController::class, 'resignApply'])->name('FT.resignApply');

Route::get('/search', [ForeignTechicianController::class, 'search'])->name('FT.search');

//Director
Route::get('/director_list', [App\Http\Controllers\DirectorController::class, 'list'])->name('director.list');
Route::get('/director',[App\Http\Controllers\DirectorController::class,'index'])->name('director.show');
Route::get('/director_create',[App\Http\Controllers\DirectorController::class,'create'])->name('director.create');
Route::post('/directorcreate',[App\Http\Controllers\DirectorController::class,'store'])->name('director.store');
Route::get('/director_edit/{director_id}',[App\Http\Controllers\DirectorController::class,'edit'])->name('director.edit');
Route::post('/director_update/{director_id}',[App\Http\Controllers\DirectorController::class,'update'])->name('director.update');
Route::get('/director_delete/{director_id}',[App\Http\Controllers\DirectorController::class,'delete'])->name('director.delete');
Route::get('/search_director', [DirectorController::class, 'search'])->name('director.search');

//Dependant 
Route::get('/dependant',[DependantController::class, 'index'])->name('DP.show');
Route::get('/dependent_create',[DependantController::class, 'create'])->name('DP.create');
Route::post('/dependant_store',[DependantController::class, 'store'])->name('DP.store');
Route::get('/dependant_lists', [DependantController::class, 'list'])->name('DP.list');
Route::get('/dependant/{dependant_id}', [DependantController::class, 'edit'])->name('DP.edit');
Route::post('/dependantupdate/{dependant_id}',[DependantController::class, 'update'])->name('DP.update');
Route::get('/dependantdelete/{dependant_id}',[DependantController::class, 'delete'])->name('DP.delete');
Route::get('/search_dp', [DependantController::class, 'search'])->name('DP.search');


// Resign List on Admin Dashboard
Route::get('/resignList', [AdminController::class, 'resignList'])->name('resignList')->middleware('adminrank');
Route::get('/resignShow/{id}', [AdminController::class, 'resignShow'])->name('resignShow')->middleware('adminrank');

Route::get('/approveForeignResign/{id}', [AdminController::class, 'approveForeignResign'])->name('approveForeignResign')->middleware('adminrank');
Route::post('/rejectForeignResign/{id}', [AdminController::class, 'rejectForeignResign'])->name('rejectFoeignResign')->middleware('adminrank');

// Foreign Technicians Excel Export on Admin Dashboard
Route::get('foreign_technicians/{foreign_id}/export', [AdminController::class, 'foreignExport'])->name('FT.export')->middleware('adminrank');
Route::get('directors/{directors_id}/export', [AdminController::class, 'directorsExport'])->name('DT.export')->middleware('adminrank');
Route::get('dependants/{dependants_id}/export', [AdminController::class, 'dependantsExport'])->name('DP.export')->middleware('adminrank');


// Applicant List on Dashboard
Route::get('/applicantList', [AdminController::class, 'applicantList'])->name('applicantList');
Route::get('/applicantsExport', [AdminController::class, 'applicantsExport'])->name('applicantsExport');


// Approve Modal
Route::get('/approvedVisa', [HomeController::class, 'approvedVisa'])->name('approvedVisa');

Route::get('/undertaking', [ProfileController::class, 'undertaking'])->name('undertaking.show');
Route::get('/pdfDownload',function(){
    $file = public_path()."/undertakingPdf/poUndertakingLetter.pdf";
    $header = array(
        'Content-Type: application/pdf',
    );
    return response()->download($file, 'undertaking.pdf', $header);
});

Route::get('/wordDownload', function(){
    $file = public_path()."/undertakingWord/UndertakingLetterword.doc";
    $header = array(
        'Content-Type: application/doc',
    );
    return response()->download($file, 'undertaking.doc', $header);
});


Route::get('emailSend', [AdminController::class, 'emailSend'])->name('emailSend');
Route::post('contact/sendMail', [AdminController::class, 'sendMail'])->name('contact.mailsent');

Route::get('my-captcha', [RegisterController::class, 'myCaptcha'])->name('myCaptcha');
// Route::post('my-captcha', [RegisterController::class, 'myCaptchaPost'])->name('myCaptcha.post');
Route::get('refresh_captcha', [RegisterController::class, 'refreshCaptcha'])->name('refresh_captcha');
