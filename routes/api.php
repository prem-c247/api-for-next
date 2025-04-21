<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, AuthController, ProfileController};

const POST_ROUTE = '/{post}';

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth:api'])->prefix('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/update', [ProfileController::class, 'update']);
});

Route::get('/check', function () {
    // $admin = Spatie\Permission\Models\Role::findByName('admin');
    // dd($admin->guard_name); // Should be 'api'
    // $user = auth()->user();
    // dd($user);
    // return [
    //     'roles' => $user->getRoleNames(),
    //     'permissions' => $user->getAllPermissions()->pluck('name'),
    // ];
    $user = App\Models\User::find(1); // or whatever user ID
    $a = $user->roles->pluck('name'); // Should show ['admin']
    $b = $user->roles->pluck('guard_name');
    dd($a,$b, $user);
})->middleware('auth:api');

// Route::middleware(['auth:api', 'role:admin', 'permission:edit post|delete post|create post'])->prefix('posts')->group(function () {
//     Route::get('/', [PostController::class, 'index']);
//     Route::post('/', [PostController::class, 'store']);
//     Route::post('/{postId}', [PostController::class, 'update']);
//     Route::get('/{postId}', [PostController::class, 'show']);
//     Route::delete('/{post}', [PostController::class, 'destroy']);
// });

// 🟢 View posts (admin & editor)
Route::middleware(['auth:api', 'permission:view post'])->prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{postId}', [PostController::class, 'show']);
});

// 🟡 Create & edit (admin & editor)
Route::middleware(['auth:api', 'permission:create post|edit post'])->prefix('posts')->group(function () {
    Route::post('/', [PostController::class, 'store']);
    Route::post('/{postId}', [PostController::class, 'update']);
});

// 🔴 Delete (admin only)
Route::middleware(['auth:api', 'permission:delete post'])->prefix('posts')->group(function () {
    Route::delete('/{post}', [PostController::class, 'destroy']);
});