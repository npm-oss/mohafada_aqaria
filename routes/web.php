<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NegativeCertificateController; 
use App\Http\Controllers\Admin\NegativeCertificateAdminController;
use App\Http\Controllers\Admin\documentsAdminController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\CertificateController;


/*
|--------------------------------------------------------------------------
| الصفحة الرئيسية
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');

/*
|--------------------------------------------------------------------------
| صفحات عامة
|--------------------------------------------------------------------------
*/
Route::view('/appointment', 'appointment')->name('appointment');
Route::view('/extract-documents', 'extract-documents')->name('extract.documents');
Route::view('/extract-topographic', 'extract-topographic')->name('extract.topographic');

/*
|--------------------------------------------------------------------------
| شهادة سلبية (Front)
|--------------------------------------------------------------------------
*/
Route::prefix('negative-certificate')->group(function () {

    // القائمة
    Route::get('/', function () {
        return view('negative.index');
    })->name('negative.index');

    // طلب جديد
    Route::get('/new', [NegativeCertificateController::class, 'new'])
        ->name('negative.new');

    // حفظ الطلب
    Route::post('/store', [NegativeCertificateController::class, 'store'])
        ->name('negative.store');

    // إعادة استخراج
    Route::get('/reprint', [NegativeCertificateController::class, 'reprint'])
        ->name('negative.reprint');
});

/*
|--------------------------------------------------------------------------
| اتصل بنا
|--------------------------------------------------------------------------
*/
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Dashboard المستخدم (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| لوحة تحكم الأدمن
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);

        Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
        Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
        Route::get('/certificates', [AdminController::class, 'certificates'])->name('certificates');

        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'settingsUpdate'])->name('settings.update');

        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');

        Route::get('/items', [AdminController::class, 'items'])->name('items');

        Route::get('/change-password', [AdminController::class, 'changePasswordForm'])
            ->name('change-password.form');
        Route::post('/change-password', [AdminController::class, 'changePassword'])
            ->name('change-password');

        Route::get('/negative-requests', [AdminController::class, 'negativeRequests'])
            ->name('negative.requests');
        Route::get('/document-requests', [AdminController::class, 'documentRequests'])
            ->name('document.requests');
        Route::get('/payment-requests', [AdminController::class, 'paymentRequests'])
            ->name('payment.requests');
        Route::get('/topographic-requests', [AdminController::class, 'topographicRequests'])
            ->name('topographic.requests');

        // محرر القوالب
        Route::get('/templates/editor', [App\Http\Controllers\Admin\TemplateEditorController::class, 'index'])
            ->name('templates.editor');
        
        Route::get('/templates/editor-frame/{type}', function($type) {
            $templateNames = [
                'negative-certificate' => 'شهادة سلبية',
                'property-card' => 'بطاقة عقارية'
            ];
            
            return view('admin.templates.editor-frame', [
                'templateType' => $type,
                'templateName' => $templateNames[$type] ?? 'قالب'
            ]);
        })->name('templates.editor-frame');
        
        Route::post('/templates/save-settings', [App\Http\Controllers\Admin\TemplateEditorController::class, 'saveSettings'])
            ->name('templates.save-settings');
        
        Route::get('/templates/load-settings/{type}', [App\Http\Controllers\Admin\TemplateEditorController::class, 'loadSettings'])
            ->name('templates.load-settings');
        
        Route::post('/templates/restore/{type}', [App\Http\Controllers\Admin\TemplateEditorController::class, 'restore'])
            ->name('templates.restore');

            

    });

require __DIR__.'/auth.php';






Route::get('/negative-certificate', function () {
    return view('negative.index');
})->name('negative.certificate');




Route::get('/negative-certificate/new', function () {
    return view('negative.new');
})->name('negative.new');















/* الصفحة الرئيسية */
Route::get('/', fn () => view('home'))->name('home');

/* شهادة سلبية */
Route::get('/negative/new', fn () => view('negative.new'))->name('negative.new');
Route::get('/negative/reprint', fn () => view('negative.reprint'))->name('negative.reprint');

/* البطاقات */
Route::get('/cards/personal', fn () => view('cards.personal'))->name('cards.personal');
Route::get('/cards/alpha', fn () => view('cards.alpha'))->name('cards.alpha');
Route::get('/cards/rural_card', fn () => view('cards.rural_card'))->name('cards.rural_card');


/* صفحات عامة */
Route::get('/contact', fn () => view('contact'))->name('contact');
Route::get('/login', fn () => view('auth.login'))->name('login');




Route::middleware(['admin', 'admin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});


Route::get('/cards/personal', fn () => view('cards.personal'))->name('cards.personal');
Route::get('/cards/alphabetical', fn () => view('cards.alphabetical'))->name('cards.alphabetical');
Route::get('/cards/rural', fn () => view('cards.rural'))->name('cards.rural');

Route::get('/extract-documents', function () {
    return view('extract-documents');
})->name('extract.documents');














/*
|--------------------------------------------------------------------------
| البطاقات العقارية
|--------------------------------------------------------------------------
*/

Route::get('/cards/natural', function () {
    return view('cards.natural');
})->name('card.natural');

Route::get('/cards/moral', function () {
    return view('cards.moral');
})->name('card.moral');

Route::get('/cards/rural_card', function () {
    return view('cards.rural_card');
})->name('card.rural_card');

Route::get('/cards/urban_private', function () {
    return view('cards.urban_private');
})->name('card.urban_private');

Route::post('/documents/store', [documentsAdminController::class, 'store'])
    ->name('admin.documents.store');

Route::prefix('admin')->group(function() {

    // فتح صفحة المعالجة
    Route::get('documents/{id}/process', [RequestController::class, 'process'])
         ->name('admin.documents.process'); // ← اسم route صحيح

    // البحث عبر AJAX
    Route::post('search-card', [RequestController::class, 'searchCard'])
         ->name('search.card');
});

/*
|--------------------------------------------------------------------------
| مستخرجات العقود
|--------------------------------------------------------------------------
*/

Route::get('/contracts/extracts', function () {
    return view('contracts.extracts');
});






/*
|--------------------------------------------------------------------------
| الوثائق المسحية
|--------------------------------------------------------------------------
*/
Route::prefix('topographic')->group(function () {

    Route::get('/scanned', function () {
        return view('topographic.scanned');
    })->name('topographic.scanned');

    Route::get('/unscanned', function () {
        return view('topographic.unscanned');
    })->name('topographic.unscanned');

    Route::get('/rural', function () {
        return view('topographic.rural');
    })->name('topographic.rural');

});



Route::get('/extract/unscanned', function () {
    return view('topographic.unscanned');
})->name('extract.unscanned');


Route::get('/extract/topographic/rural', function () {
    return view('topographic.rural');
})->name('extract.rural');






/*
|--------------------------------------------------------------------------
| Public Routes (المواطن)
|--------------------------------------------------------------------------
*/

Route::prefix('negative-certificate')->group(function () {
    Route::get('/new', [NegativeCertificateController::class, 'new'])
        ->name('negative.new');

    Route::post('/store', [NegativeCertificateController::class, 'store'])
        ->name('negative.store');
});


/*
|--------------------------------------------------------------------------
| Admin Routes (الأدمن فقط – بدون فورم إنشاء)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['admin', 'admin'])
    ->group(function () {

        // قائمة الطلبات
        Route::get('/certificates',
            [NegativeCertificateAdminController::class, 'index']
        )->name('certificates.index');

        // عرض طلب واحد
        Route::get('/certificates/{id}',
            [NegativeCertificateAdminController::class, 'show']
        )->name('certificates.show');

        // تغيير الحالة
        Route::post('/certificates/{id}/approve',
            [NegativeCertificateAdminController::class, 'approve']
        )->name('certificates.approve');

        Route::post('/certificates/{id}/reject',
            [NegativeCertificateAdminController::class, 'reject']
        )->name('certificates.reject');

        Route::post('/certificates/{id}/extract',
            [NegativeCertificateAdminController::class, 'extract']
        )->name('certificates.extract');

        // صفحة المعالجة
Route::get('/certificates/{id}/process',
    [NegativeCertificateAdminController::class, 'process']
)->name('certificates.process');

Route::post('/certificates/{id}/update-fields', 
    [NegativeCertificateAdminController::class, 'updateFields']
)->name('certificates.updateFields');

// مسارات الطباعة
Route::get('/certificates/{id}/print', 
    [App\Http\Controllers\Admin\PrintController::class, 'printNegativeCertificate']
)->name('certificates.print');

Route::get('/documents/{id}/print', 
    [App\Http\Controllers\Admin\PrintController::class, 'printPropertyCard']
)->name('documents.print');









});




Route::prefix('admin')->middleware(['admin','admin'])->name('admin.')->group(function () {

    Route::get('/documents', [documentsAdminController::class,'index'])
        ->name('documents.index');

    Route::get('/documents/{id}', [documentsAdminController::class,'show'])
        ->name('documents.show');

    Route::post('/documents/store', [documentsAdminController::class,'store'])
        ->name('documents.store');

    Route::post('/documents/{id}/approve', [documentsAdminController::class,'approve'])
        ->name('documents.approve');

    Route::post('/documents/{id}/reject', [documentsAdminController::class,'reject'])
        ->name('documents.reject');

    Route::post('/documents/{id}/extract', [documentsAdminController::class,'extract'])
        ->name('documents.extract');

    Route::delete('/documents/{id}', [documentsAdminController::class,'destroy'])
        ->name('documents.destroy');


      
});


// صفحة البطاقة الشخصية


// Route لحفظ الطلبات عبر documentsAdminController
Route::post('/documents/store', [documentsAdminController::class, 'store'])->name('admin.documents.store');




























// إذا لم يكن لديك Controller لطلبات المستخدمين
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/requests/create', [UserRequestController::class, 'create'])->name('requests.create');
    Route::get('/requests', [UserRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests', [UserRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{id}/edit', [UserRequestController::class, 'edit'])->name('requests.edit');
    Route::put('/requests/{id}', [UserRequestController::class, 'update'])->name('requests.update');
    Route::get('/requests/{id}', [UserRequestController::class, 'show'])->name('requests.show');
});












Route::prefix('admin')->name('admin.')->group(function() {
    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
});















