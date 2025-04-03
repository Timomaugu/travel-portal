<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    return redirect()->back()->with('status','Cache Cleared');
})->middleware('auth');

Route::get('/dashboard', function () {
    $department = auth()->user()->department_id;
    $users = User::when(function ($query) use ($department) {
        if ($department != '') {
            $query->where('department_id', $department);
        }
        
    })->get()->count();

    $pending = get_requisitions(0)->count();
    $approved = get_requisitions(1)->count();
    $rejected = get_requisitions(2)->count();

    return view('dashboard', compact(['users', 'pending', 'approved', 'rejected']));
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('requests', RequisitionController::class);
    
    Route::get('/notifications/view/{id}', [NotificationController::class, 'readOne'])->name('notification.view');
    Route::get('/notifications/viewAll', [NotificationController::class, 'readAll'])->name('notifications.viewAll');
    Route::get('/notifications/markas', [NotificationController::class, 'markasRead'])->name('notifications.markas');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('conversations', [MessageController::class, 'createConversation'])->name('conversation.create');
    Route::post('messages/send', [MessageController::class, 'sendMessage'])->name('message.send');
    Route::get('messages/{conversationId}', [MessageController::class, 'getMessages']);
});

Route::group(['middleware' => ['role:super-admin|admin|hod-agm-gm|director|ceo']], function() {

    Route::resource('users',  UserController::class);
    Route::resource('permissions',  PermissionController::class);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::post('/request/approve', [RequisitionController::class, 'approve'])->name('request.approve');
    Route::post('/request/reject', [RequisitionController::class, 'reject'])->name('request.reject');
    Route::get('/request/forward/{reqId}/{to}', [RequisitionController::class, 'forward'])->name('request.forward');

});

require __DIR__.'/auth.php';
