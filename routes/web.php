<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Role
Route::get('/roles', [RoleController::class, 'openRolePage'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'openCreateRolePage'])->name('roles.create');
Route::post('/store/roles', [RoleController::class, 'storeRole'])->name('store.roles');
Route::get('/role/edit/{id}', [RoleController::class, 'editRolePage'])->name('role.edit');
Route::get('/role/delete/{id}', [RoleController::class, 'deleteRole'])->name('role.delete');
Route::put('/role/update/{id}', [RoleController::class, 'updateRole'])->name('role.update');

// Permission
Route::get('/permissions', [PermissionController::class, 'openPermissionsPage'])->name('permissions.index');
Route::get('/permissions/create', [PermissionController::class, 'openCreatePermissionsPage'])->name('permissions.create');
Route::post('/store/permissions', [PermissionController::class, 'storePermissions'])->name('store.permissions');
Route::get('/permission/edit/{id}', [PermissionController::class, 'editPermissionPage'])->name('permission.edit');
Route::get('/permission/delete/{id}', [PermissionController::class, 'deletePermission'])->name('permission.delete');
Route::put('/permission/update/{id}', [PermissionController::class, 'updatePermission'])->name('permission.update');

// Assign & Revoke Permissions to Role
Route::get('/assign-permission-to-role', [RolePermissionController::class, 'assignPermissionToRoleList'])->name('assign.permission.to.role');
Route::get('/create/assign-permission-to-role', [RolePermissionController::class, 'createPermissionToRole'])->name('create.permission.to.role');
Route::post('/store/assign-permission-to-role', [RolePermissionController::class, 'storePermissionToRole'])->name('store.permission.to.role');
Route::get('/role/{role}/edit-permissions', [RolePermissionController::class, 'editRolePermissions'])->name('role.permissions.edit');
Route::put('/role/{role}/update-permissions', [RolePermissionController::class, 'updateRolePermissions'])->name('role.permissions.update');
Route::post('/role/{role}/revoke-permissions', [RolePermissionController::class, 'revokeAllPermissions'])->name('role.permissions.revoke');


// Assign & Revoke Role to/from User
Route::get('/assign-role-to-user/list', [RolePermissionController::class, 'assignRoleToUserList'])->name('assign.role.to.user.list');
Route::get('/assign-role-to-user/create', [RolePermissionController::class, 'assignRoleToUserCreate'])->name('assign.role.to.user.create');
Route::post('/assign-role-to-user/store', [RolePermissionController::class, 'assignRoleToUserStore'])->name('assign.role.to.user.store');
Route::get('/user/{user}/edit-roles', [RolePermissionController::class, 'editUserRoles'])->name('user.roles.edit');
Route::put('/user/{user}/update-roles', [RolePermissionController::class, 'updateUserRoles'])->name('user.roles.update');
Route::post('/user/{user}/revoke-roles', [RolePermissionController::class, 'revokeAllRoles'])->name('user.roles.revoke');





// Route::get('assign-permission-to-user', function(){
//     $user = User::find(2);
//     $permission = Permission::findByName('Read', 'web');
//     // ======== assign permission to user ==========//
//     // if ($user && $permission) {
//     //     $user->givePermissionTo($permission); 
//     //     return 'Permission assigned successfully!';
//     // }
//     //  return 'User or Permission not found.';

//     // $permissions = $user->getPermissionNames();
//     // dd($permissions);
//     // $revoked = $user->revokePermissionTo($permission);
//     // dd('revoked');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
