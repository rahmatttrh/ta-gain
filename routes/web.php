<?php

use App\Http\Controllers\{PagesController, PelangganController, KordinatorController, TeknisiController, JobController, ClientOrderController, FileController, JobActivityController, ReimburseAdmin, ReimburseController, ReimburseKordinator};
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [PagesController::class, 'Dashboard']);
    Route::get('/map-site', [PagesController::class, 'DashboardMapSite'])->name('map.site');
    // Route::get('job-progres', [JobController::class, 'progres'])->name('job.progres');
    // Route::get('job-detail', [JobController::class, 'detail'])->name('job.detail');
    Route::get('/jobreport-detail/{order:id}', [TeknisiController::class, 'detailJobreport'])->name('jobreport.detail');
    Route::get('/foto-report/{job_photo:id}', [ClientOrderController::class, 'fotoReport'])->name('report.foto');

    Route::get('master-bast/{order:id}', [FileController::class, 'bastMaster'])->name('job.bast');
    Route::post('upload-master-bast/{order:id}', [FileController::class, 'uploadBastMaster'])->name('upload.bast.master');
    Route::get('download-master-bast/{order:id}', [FileController::class, 'downloadBastMaster'])->name('download.bast.master');

    Route::get('bast/{order:id}', [FileController::class, 'bast'])->name('bast');
    Route::post('upload-bast/{order:id}', [FileController::class, 'uploadBast'])->name('upload.bast');
    Route::get('download-bast/{order:id}', [FileController::class, 'downloadBast'])->name('download.bast');
    Route::get('download-photo/{order:id}', [FileController::class, 'getZip'])->name('get.zip');

    Route::get('delete', [FileController::class, 'deleteStorage']);

    Route::get('/jobreport', [ClientOrderController::class, 'jobreport'])->name('client.jobreport');
    Route::get('{order:id}/job-detail/admin', [JobController::class, 'detail'])->name('job.detail.client');
    Route::get('{order:id}/jobreport-detail', [ClientOrderController::class, 'detailJobreport'])->name('client.jobreport.detail');
});

// Hak akses untuk admin
Route::middleware(['auth', 'accessAdmin'])->group(function () {
    Route::get('/client', PelangganController::class)->name('client');
    Route::get('client/create', [PelangganController::class, 'create'])->name('client.create');
    Route::post('client/create', [PelangganController::class, 'store']);
    Route::get('{pelanggan:id}/edit-client', [PelangganController::class, 'edit'])->name('client.edit');
    Route::put('{pelanggan:id}/update-client', [PelangganController::class, 'update'])->name('client.update');
    Route::get('{pelanggan:id}/delete-client', [PelangganController::class, 'delete'])->name('client.delete');

    // Route::get('{order:id}/job-detail', [JobController::class, 'detail'])->name('job.detail.client');



    Route::post('/jobreport-reject', [ClientOrderController::class, 'rejectJobreport'])->name('client.jobreport.reject');
    Route::post('/jobreport-approve', [ClientOrderController::class, 'approveJobreport'])->name('client.jobreport.approve');
    Route::post('/approve/{order:id}', [ClientOrderController::class, 'approve'])->name('job.approve');
    Route::post('/approve-bast/{order:id}', [ClientOrderController::class, 'approveBast'])->name('approve.bast');

    Route::get('/kordinator', KordinatorController::class)->name('kordinator');
    Route::get('kordinator/create', [KordinatorController::class, 'create'])->name('kordinator.create');
    Route::post('kordinator/create', [KordinatorController::class, 'store']);
    Route::get('{kordinator:id}/edit', [KordinatorController::class, 'edit'])->name('kordinator.edit');
    Route::put('{kordinator:id}/update', [KordinatorController::class, 'update'])->name('kordinator.update');
    Route::get('{kordinator:id}/delete', [KordinatorController::class, 'delete'])->name('kordinator.delete');

    Route::get('/teknisi',  TeknisiController::class)->name('teknisi');
    Route::get('/teknisi/create', [TeknisiController::class, 'create'])->name('teknisi.create');
    Route::post('teknisi/create', [TeknisiController::class, 'store']);
    Route::get('{teknisi:id}/edit-teknisi', [TeknisiController::class, 'edit'])->name('teknisi.edit');
    Route::put('{teknisi:id}/update-teknisi', [TeknisiController::class, 'update'])->name('teknisi.update');
    Route::get('{teknisi:id}/delete-teknisi', [TeknisiController::class, 'delete'])->name('teknisi.delete');

    Route::get('job-order', JobController::class)->name('job');
    Route::get('job-create', [JobController::class, 'create'])->name('job.create');
    Route::post('job-create', [JobController::class, 'store']);
    Route::get('{order:id}/job-edit', [JobController::class, 'edit'])->name('job.edit');
    Route::put('{order:id}/job-update', [JobController::class, 'update'])->name('job.update');

    Route::post('job-create', [JobController::class, 'store']);

    Route::get('job-draft', [JobController::class, 'draft'])->name('job.draft');
    Route::get('{pelanggan:id}/job-draft', [JobController::class, 'draftPelanggan'])->name('job.draft.detail');
    Route::post('job-draft', [JobController::class, 'publish']);

    Route::get('job-delegasi', [JobController::class, 'delegasi'])->name('job.delegasi');
    Route::get('{joborder:id}/job-delegasi', [JobController::class, 'delegasiOrder'])->name('job.delegasi.detail');
    Route::post('job-delegasi', [JobController::class, 'handOver'])->name('job.delegasi');

    // Route::get('job-progres', [JobController::class, 'progres'])->name('job.progres');
    Route::get('{order:id}/job-detail/administratot', [JobController::class, 'detail'])->name('job.detail.admin');
    Route::post('payment/{order:id}', [JobController::class, 'paymentKonfirmasi'])->name('payment.konfirmasi');


    Route::get('job-finish', [JobController::class, 'finish'])->name('job.finish');
    Route::get('job-ready-to-pay', [JobController::class, 'ready'])->name('job.ready');
    Route::get('job-complete', [JobController::class, 'complete'])->name('job.complete');

    // Reimburse admin
    Route::get('/job-reimburse-admin', [ReimburseAdmin::class, 'index'])->name('reimburse.admin');
    Route::get('{order:id}/job-reimburse-admin/', [ReimburseAdmin::class, 'show'])->name('job.reimburse.admin');
    // Route::get('{order:id}/job-reimburse/', [ReimburseAdmin::class, 'create'])->name('job.reimburse');

    // Validasi Mark up Harga
    Route::get('/validasi-reimburse/{job:id}', [ReimburseAdmin::class, 'edit'])->name('validasi.reimburse');
    Route::put('/revisi-reimburse/{job:id}', [ReimburseAdmin::class, 'update'])->name('revisi.reimburse');
});

// Hak akses untuk Client
Route::middleware(['auth', 'accessClient'])->group(function () {
    Route::get('/profile/client', [ClientOrderController::class, 'profile'])->name('profile.client');
    // Route::get('{order:id}/job-detail/client', [JobController::class, 'detail'])->name('job.detail.client');
    Route::put('{pelanggan:id}/update-client-profile', [PelangganController::class, 'update'])->name('client.update.profile');

    Route::get('/client-order', [ClientOrderController::class, 'index'])->name('client-order');
    Route::get('/create-order', [ClientOrderController::class, 'create'])->name('create-order');
    Route::post('/create-order', [ClientOrderController::class, 'store'])->name('order.store');

    Route::post('/job-cancel', [ClientOrderController::class, 'cancel'])->name('job.cancel.client');

    // Route::get('/client-jobreport', [ClientOrderController::class, 'jobreport'])->name('client.jobreport');
    // Route::get('{order:id}/jobreport-detail/client', [ClientOrderController::class, 'detailJobreport'])->name('client.jobreport.detail');
    // Route::post('/client-jobreport-reject', [ClientOrderController::class, 'rejectJobreport'])->name('client.jobreport.reject');
    // Route::post('/client-jobreport-approve', [ClientOrderController::class, 'approveJobreport'])->name('client.jobreport.approve');


    Route::get('/client-finish', [ClientOrderController::class, 'finish'])->name('finish.order');

    Route::get('/client-ready', [ClientOrderController::class, 'ready'])->name('ready.order');
    Route::get('/client-complete', [ClientOrderController::class, 'complete'])->name('complete.order');

    // Route::post('/approve/{order:id}', [ClientOrderController::class, 'approve'])->name('job.approve');
    // Route::post('/approve-bast/{order:id}', [ClientOrderController::class, 'approveBast'])->name('approve.bast');
});

// Hak akses untuk Kordinator
Route::middleware(['auth', 'accessKordinator'])->group(function () {
    Route::get('/profile/kordinator', [KordinatorController::class, 'profile'])->name('profile.kordinator');
    Route::put('{kordinator:id}/update/profile', [KordinatorController::class, 'update'])->name('kordinator.update.profile');

    Route::get('/kordinator-inbox', [KordinatorController::class, 'inbox'])->name('kordinator.inbox');
    Route::get('{joborder:id}/kordinator-inbox', [KordinatorController::class, 'inboxDetail'])->name('kordinator.inbox.detail');
    Route::post('kordinator-inbox', [KordinatorController::class, 'inboxRespond'])->name('kordinator.inbox');

    Route::get('/kordinator-delegasi', [KordinatorController::class, 'delegasi'])->name('kordinator.delegasi');
    Route::get('{joborder:id}/kordinator-delegasi', [KordinatorController::class, 'delegasiOrder'])->name('kordinator.delegasi.detail');
    Route::post('/kordinator-delegasi', [KordinatorController::class, 'handOver'])->name('kordinator.delegasi');

    Route::get('/kordinator-order', [KordinatorController::class, 'order'])->name('order.kordinator');
    Route::get('/kordinator-order-progres', [KordinatorController::class, 'order'])->name('order.progres.kordinator');

    Route::get('{order:id}/job-detail', [JobController::class, 'detail'])->name('job.detail.kordinator');
    Route::get('job-detail', [JobController::class, 'detail'])->name('job.detail');
    Route::post('{order:id}/activity', [JobActivityController::class, 'activity'])->name('job.activity');
    Route::post('{order:id}/finish', [JobActivityController::class, 'finishJob'])->name('finish.job');
    Route::post('/pending', [JobActivityController::class, 'pendingJob'])->name('pending.job');
    Route::post('{order:id}/continue', [JobActivityController::class, 'continueJob'])->name('continue.job');


    Route::get('{order:id}/job-edit/kordinator', [KordinatorController::class, 'editJob'])->name('job.edit.kordinator');
    Route::put('{order:id}/job-update/kordinator', [KordinatorController::class, 'updateJob'])->name('job.update.kordinator');

    Route::get('/kordinator-teknisi', [KordinatorController::class, 'teknisi'])->name('teknisi.kordinator');
    Route::get('/kordinator-finish', [KordinatorController::class, 'finish'])->name('finish.kordinator');
    Route::get('/kordinator-payment', [KordinatorController::class, 'payment'])->name('payment.kordinator');
    Route::get('/kordinator-complete', [KordinatorController::class, 'complete'])->name('complete.kordinator');
    Route::get('/kordinator-wallet', [KordinatorController::class, 'wallet'])->name('wallet.kordinator');
    Route::get('/kordinator-withdraw', [KordinatorController::class, 'withdraw'])->name('withdraw.kordinator');

    // Reimburse kordinator
    Route::get('{order:id}/job-reimburse-kordinator/', [ReimburseKordinator::class, 'create'])->name('job.reimburse.kordinator');
    Route::post('job-reimburse/', [ReimburseKordinator::class, 'store'])->name('reimburse.store');
});

// Hak akses untuk Teknisi
Route::middleware(['auth', 'accessTeknisi'])->group(function () {
    Route::get('/profile/teknisi', [TeknisiController::class, 'profile'])->name('profile.teknisi');
    Route::put('{teknisi:id}/update/profile/my', [TeknisiController::class, 'update'])->name('teknisi.update.profile');

    Route::get('/teknisi-order', [TeknisiController::class, 'order'])->name('order.teknisi');

    Route::get('/teknisi-jobreport', [TeknisiController::class, 'jobreport'])->name('jobreport.teknisi');
    Route::POST('/teknisi-jobreport', [TeknisiController::class, 'storeJobreport'])->name('jobreport.create.teknisi');
    // Route::POST('/teknisi-revisi-jobreport', [TeknisiController::class, 'revisiJobreport'])->name('jobreport.revisi.teknisi');

    // Jumat 7 Januari
    Route::get('/revisi/{job:id}', [TeknisiController::class, 'revisiReport'])->name('revisi.report');
    Route::put('/revisi-report/{job:id}', [TeknisiController::class, 'updateRevisi'])->name('update.revisi.teknisi');


    Route::get('/teknisi-finish', [TeknisiController::class, 'finish'])->name('finish.teknisi');
    Route::get('/teknisi-payment', [TeknisiController::class, 'payment'])->name('payment.teknisi');
    Route::get('/teknisi-complete', [TeknisiController::class, 'complete'])->name('complete.teknisi');
    Route::get('/teknisi-wallet', [TeknisiController::class, 'wallet'])->name('wallet.teknisi');
    Route::get('/teknisi-withdraw', [TeknisiController::class, 'withdraw'])->name('withdraw.teknisi');

    Route::get('{order:id}/job-detail/teknisi', [JobController::class, 'detail'])->name('job.detail.teknisi');
});



require __DIR__ . '/auth.php';
