<?php

Route::get('/coba', function(){
	return view('coba'); 
});
Route::get('/', ['uses' => 'WelcomeController@getSignIn', 'as' => 'main']);
Route::get('/register', 'WelcomeController@getRegister');
Route::post('register', ['uses' => 'RegisterController@store', 'as' => 'register.store']);
Route::post('/', ['uses' => 'AuthController@postLogIn', 'as'=>'login.post']);

//password reset routes
Route::get('password/reset/{token}', 'Auth\PasswordController@showResetForm');
Route::get('password/reset', 'Auth\PasswordController@showLinkRequestForm');
Route::post('password/reset', 'Auth\PasswordController@reset');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');	

//admin
Route::get('/admin',[
	'uses' => 'AdminController@AdminHome',
	'as' => 'admin.home',
	'middleware' => 'roles',
	'roles' => ['Admin'] 
]); 

Route::get('/admin/users', [
	'uses' => 'AdminController@showUser',
	'as' => 'admin.users',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/users/tambah-auditor', [
	'uses' => 'AdminController@addAuditor',
	'as' => 'admin.tambah-auditor',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/users/tambah-auditor', [
	'uses' => 'AdminController@storeAuditor',
	'as' => 'admin.store-auditor',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/users/tambah-user', [
	'uses' => 'AdminController@addUser',
	'as' => 'admin.tambah-user',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/users/tambah-user', [
	'uses' => 'AdminController@storeUser',
	'as' => 'admin.store-user',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

//edit auditor
Route::get('/admin/users-auditor/{id}/edit', [
	'uses' => 'AdminController@editAuditor',
	'as' => 'admin.edit-auditor',
	'middleware' => 'roles',
	'roles' => ['Admin'] 
]);

Route::put('/admin/users-auditor/{id}', [
	'uses' => 'AdminController@updateAuditor',
	'as' => 'admin.update-auditor',
	'middleware' => 'roles',
	'roles' => ['Admin'] 
]);

//edit user
Route::get('/admin/users/{id}/edit', [
	'uses' => 'AdminController@editUser',
	'as' => 'admin.edit-user',
	'middleware' => 'roles',
	'roles' => ['Admin'] 
]);

Route::put('/admin/users/{id}', [
	'uses' => 'AdminController@updateUser',
	'as' => 'admin.update-user',
	'middleware' => 'roles',
	'roles' => ['Admin'] 
]);

Route::delete('/admin/users/{id}', [
	'uses' => 'AdminController@deleteUser',
	'as' => 'admin.destroy-user',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/jurusan', [
	'uses' => 'AdminController@showJurusan',
	'as' => 'admin.jurusan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/jurusan/tambah', [
	'uses' => 'AdminController@tambahJurusan',
	'as' => 'admin.tambahjurusan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/jurusan/tambah', [
	'uses' => 'AdminController@storeJurusan',
	'as' => 'admin.simpanjurusan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/jurusan/{id}/edit', [
	'uses' => 'AdminController@editJurusan',
	'as' => 'admin.editjurusan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::put('/admin/jurusan/{id}', [
	'uses' => 'AdminController@updateJurusan',
	'as' => 'admin.updatejurusan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::delete('/admin/jurusan/{id}', [
	'uses' => 'AdminController@deleteJurusan',
	'as' => 'admin.destroy-jurusan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/borang', [
	'uses' => 'BorangController@showBorang', 
	'as' => 'borang.show',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/borang/{id}/edit', [
	'uses' => 'BorangController@editBorang',
	'as' => 'borang.edit',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::patch('/borang/{id}', [
	'uses' => 'BorangController@updateBorang',
	'as' => 'borang.update'	
]);

Route::get('/admin/standard-borang', [
	'uses' => 'BorangController@showStandardBorang',
	'as' => 'admin.standardborang',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/standard-borang/tambah', [
	'uses' => 'BorangController@tambahStandardBorang',
	'as' => 'admin.tambahstandardborang',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/standard-borang/tambah', [
	'uses' => 'BorangController@simpanStandardBorang',
	'as' => 'admin.simpanstandardborang',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/standard-borang/{id}/edit', [
	'uses' => 'BorangController@editStandardBorang',
	'as' => 'admin.editstandardborang',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::put('/admin/standard-borang/{id}', [
	'uses' => 'BorangController@updateStandardBorang',
	'as' => 'admin.updatestandardborang',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::delete('/admin/standard-borang/{id}', [
	'uses' => 'BorangController@hapusStandardBorang',
	'as' => 'admin.destroy-standard',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/profil', [
	'uses' => 'AdminController@profil',
	'as' => 'admin.profil',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/profil/{id}/edit', [
	'uses' => 'AdminController@profilEdit',
	'as' => 'admin.editprofil',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);
Route::put('/admin/profil/{id}', [
	'uses' => 'AdminController@profilUpdate',
	'as' => 'admin.updateprofil',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);
Route::get('/admin/editpassword/{id}/edit', [
	'uses' => 'AdminController@editPassword',
	'as' => 'admin.editpassword',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);
Route::put('/admin/editpassword/{id}', [
	'uses' => 'AdminController@updatePassword',
	'as' => 'admin.updatepassword',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/hak-akses-auditor', [
	'uses' => 'AdminController@hakAksesAuditor',
	'as' => 'admin.haksesauditor',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/hak-akses-auditor/{id}', [
	'uses' => 'AdminController@hakAksesAuditorId',
	'as' => 'admin.haksesauditorid',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/hak-akses-auditor/{id}/tambah', [
	'uses' => 'AdminController@hakAksesAuditorTambah',
	'as' => 'admin.haksesauditortambah',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::delete('/hak-akses-auditor/{id_akses}', [
	'uses' => 'AdminController@hakAksesAuditorHapus',
	'as' => 'admin.haksesauditorhapus',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);


Route::post('/hak-akses-auditor', [
	'uses' => 'AdminController@hakAksesAuditorSimpan',
	'as' => 'admin.haksesauditorsimpan',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/dokumen', [
	'uses' => 'DokumenController@index',
	'as' => 'dokumen.index',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/dokumen/tambah', [
	'uses' => 'DokumenController@create',
	'as' => 'dokumen.create',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/dokumen/tambah', [
	'uses' => 'DokumenController@store',
	'as' => 'dokumen.store',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/dokumen/{id}/edit', [
	'uses' => 'DokumenController@edit',
	'as' => 'dokumen.edit',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::put('/dokumen/{id}', [
	'uses' => 'DokumenController@update',
	'as' => 'dokumen.update',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::delete('/dokumen/{id}', [
	'uses' => 'DokumenController@delete',
	'as' => 'dokumen.delete',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

//user
Route::get('/user', [
	'uses' => 'UserController@getHome',
	'as' => 'user.home',
	'middleware' => 'roles',
	'roles' => ['User']

]);

Route::get('/user/borang', [
	'uses' => 'UserBorangController@getBorang',
	'as' => 'user.borang',
	'middleware' => 'roles',
	'roles' => ['User']
]);

/*user borang golongan untuk nobutir yang lebih dari 1*/
Route::get('/user/multiple-borang/{golongan}', [
	'uses' => 'UserBorangController@getMultipleBorang',
	'as' => 'user.multipleborang',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::post('/user/multiple-borang/{golongan}', [
	'uses' => 'UserBorangController@postMultipleBorang',
	'as' => 'user.multipleborangpost',
	'middleware' => 'roles',
	'roles' => ['User']
]);
/*end of user bora*/


Route::get('/user/full-borang', [
	'uses' => 'UserBorangController@getBorangForm',
	'as' => 'user.borangfullform',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/full-borang/{id}/edit', [
	'uses' => 'UserBorangController@getBorangFullEdit',
	'as' => 'user.borangfulledit',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::put('/user/full-borang/{id}', [
	'uses' => 'UserBorangController@BorangFullUpdate',
	'as' => 'user.borangfullupdate',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::post('/user/post-full-borang', [
	'uses' => 'UserBorangController@postFullBorang',
	'as' => 'user.borangfullpost',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/borang/{id}', [
	'uses' => 'UserBorangController@showSelectedBorang',
	'as' => 'userborang.show',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::post('/user/borang', [
	'uses' => 'UserBorangController@postBorang',
	'as' => 'borang.submit',
	'middleware' => 'roles',
	'roles' => ['User'] 
]);

Route::post('/user/fileborang', [
	'uses' => 'UserBorangController@postFileBorang',
	'as' => 'borang.filesubmit',
	'middleware' => 'roles',
	'roles' => ['User'] 
]);

Route::get('/user/profil', [
	'uses' => 'UserController@profil',
	'as' => 'user.profil',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/profil/{id}/edit', [
	'uses' => 'UserController@editProfil',
	'as' => 'user.profiledit',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::put('/user/profil/{id}', [
	'uses' => 'UserController@updateProfil',
	'as' => 'user.profilupdate',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/password/{id}/edit', [
	'uses' => 'UserController@editPassword',
	'as' => 'user.passwordedit',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::put('/user/password/{id}', [
	'uses' => 'UserController@updatePassword',
	'as' => 'user.passwordupdate',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/isian', [
	'uses' => 'UserBorangController@isianBorang',
	'as' => 'isian.index',
	'middleware' => 'roles',
	'roles' => ['User'] 
]);

Route::get('/user/isian/{tahun}', [
	'uses' => 'UserBorangController@tahunIsian',
	'as' => 'isian.tahun',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/isian/{tahun}/full', [
	'uses' => 'UserBorangController@tahunIsianFull',
	'as' => 'isian.tahunfull',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/isian/{tahun}/chart', [
	'uses' => 'UserBorangController@tahunIsianChart',
	'as' => 'isian.tahunchart',
	'middleware' => 'roles',
	'roles' => ['User']
]);


Route::get('/user/isian-borang/{id}', [
	'uses' => 'UserBorangController@detailIsian',
	'as' => 'isian.single-page',
	'middleware' => 'roles',
	'roles' => ['User']
]);



//tampilin edit isian
Route::get('/edit-isian/{id}', [
	'uses' => 'UserBorangController@editIsian',
	'as' => 'isian.edit',
	'middleware' => 'roles',
	'roles' => ['User']
]);
//simpan isian yang di edit
Route::put('/edit-isian/{id}', [
	'uses' => 'UserBorangController@updateIsian',
	'as' => 'isian.update',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/edit-isianfile/{id}/edit', [
	'uses' => 'UserBorangController@editIsianFile',
	'as' => 'isian.fileedit',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::patch('/edit-isianfile/{id}', [
	'uses' => 'UserBorangController@updateIsianFile',
	'as' => 'isian.fileupdate',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/ekspor-pdf/{tahun}', [
	'uses' => 'UserBorangController@pdf',
	'as' => 'user.ekspor-pdf',
	'middleware' => 'roles',
	'roles' => ['User']
]);

Route::get('/user/dokumen', [
	'uses' => 'UserBorangController@getDokumen',
	'as' => 'user.dokumen',
	'middleware' => 'roles',
	'roles' => ['User']
]);

//auditor
Route::get('/auditor', [
	'uses' => 'AuditorController@auditorHome',
	'as' => 'auditor.home',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian', [
	'uses' => 'AuditorController@isianUser',
	'as' => 'auditor.isianuser',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian/{id_jurusan}/{tahun}', [
	'uses' => 'AuditorController@isianUserDetil',
	'as' => 'auditor.isianuserdetail',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian/{id_jurusan}/{tahun}/pdf', [
	'uses' => 'AuditorController@nyetakPdf',
	'as' => 'auditor.isianuserdetailpdf',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian/{id_jurusan}/{tahun}/full', [
	'uses' => 'AuditorController@isianUserDetailFull',
	'as' => 'auditor.isianuserdetailfull',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian/{id_jurusan}/{tahun}/chart', [
	'uses' => 'AuditorController@isianUserDetailChart',
	'as' => 'auditor.isianuserdetailchart',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian-user/{id}', [
	'uses' => 'AuditorController@isianUserSinglePage',
	'as' => 'auditor.isianusersinglepage',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/isian-user-komentar/{id}/edit', [
	'uses' => 'AuditorController@isianUserKomentar',
	'as' => 'auditor.isiankomentar',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::put('/isian-user-komentar/{id}', [
	'uses' => 'AuditorController@isianUserKomentarSimpan',
	'as' => 'auditor.isiankomentarsimpan',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/penilaian/{id}/nilai', [
	'uses' => 'AuditorController@inputSkor',
	'as' => 'auditor.inputskor',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::put('penilaian/{id}', [
	'uses' => 'AuditorController@simpanSkor',
	'as' => 'auditor.simpanskor',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('edit-penilaian/{id}/edit', [
	'uses' => 'AuditorController@editSkor',
	'as' => 'auditor.editskor',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::put('edit-penilaian/{id}', [
	'uses' => 'AuditorController@updateSkor',
	'as' => 'auditor.updateskor',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/auditor/profil', [
	'uses' => 'AuditorController@profil',
	'as' => 'auditor.profil',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/auditor/profil/{id}/edit', [
	'uses' => 'AuditorController@profilEdit',
	'as' => 'auditor.editprofil',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);
Route::put('/auditor/profil/{id}', [
	'uses' => 'AuditorController@profilUpdate',
	'as' => 'auditor.updateprofil',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);
Route::get('/auditor/editpassword/{id}/edit', [
	'uses' => 'AuditorController@editPassword',
	'as' => 'auditor.editpassword',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);
Route::put('/auditor/editpassword/{id}', [
	'uses' => 'AuditorController@updatePassword',
	'as' => 'auditor.updatepassword',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

Route::get('/auditor/dokumen', [
	'uses' => 'AuditorController@getDokumen',
	'as' => 'auditor.dokumen',
	'middleware' => 'roles',
	'roles' => ['Auditor']
]);

//logout
Route::get('/logout', 'LogoutController@getLogout');