<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{





    // Assign Permission to Role

    public function assignPermissionToRoleList()
    {
        $permissionsToRoles = Role::with('permissions')->get()->filter(function ($role) {
            return $role->permissions->isNotEmpty();
        });
        return view('role-permission.assignPermissionToRoleList', compact('permissionsToRoles'));
    }
    public function createPermissionToRole()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('role-permission.createPermissionToRole', compact('roles', 'permissions'));
    }

    public function storePermissionToRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ]);

        $role = Role::findById($request->role_id, 'web');
        $permissions = Permission::whereIn('id', $request->permission_ids)->get();

        $role->syncPermissions($permissions); // or ->givePermissionTo($permissions) to append without removing old ones

        return redirect()->route('assign.permission.to.role')->with('success', 'Permissions assigned to role!');
    }


    public function editRolePermissions(Role $role)
    {
        $permissions = Permission::all();
        $assigned = $role->permissions->pluck('id')->toArray();
        return view('role-permission.editRolePermissions', compact('role', 'permissions', 'assigned'));
    }

    public function updateRolePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ]);
        $permissions = Permission::whereIn('id', $request->permission_ids)->get();
        $role->syncPermissions($permissions);
        return redirect()->route('assign.permission.to.role')->with('success', 'Permissions updated.');
    }
    public function revokeAllPermissions(Role $role)
    {
        $role->syncPermissions([]);
        return back()->with('success', 'All permissions revoked from role.');
    }





    // Assign Role to user 

    public function assignRoleToUserList()
    {
        $users = User::with('roles')->paginate(10);
        return view('assign.assignRoleToUserList', compact('users'));
    }
    public function assignRoleToUserCreate()
    {
        $roles = Role::all();
        $users = User::all();
        return view('assign.assignRoleToUserCreate', compact('users', 'roles'));
    }
    public function assignRoleToUserStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);
        $user = User::findOrFail($request->user_id);
        $roles = Role::whereIn('id', $request->role_ids)->get();
        $user->syncRoles($roles); // Use assignRole() if you don't want to overwrite

        return redirect()->route('assign.role.to.user.list')->with('success', 'Roles assigned to user successfully.');
    }

    public function editUserRoles(User $user)
    {
        $roles = Role::all();
        $assigned = $user->roles->pluck('id')->toArray();
        return view('assign.editUserRoles', compact('user', 'roles', 'assigned'));
    }

    public function updateUserRoles(Request $request, User $user)
    {
        $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);
        $roles = Role::whereIn('id', $request->role_ids)->get();
        $user->syncRoles($roles);
        return redirect()->route('assign.role.to.user.list')->with('success', 'User roles updated.');
    }

    
    public function revokeAllRoles(User $user)
    {
        $user->syncRoles([]);
        return back()->with('success', 'All roles revoked from user.');
    }
}
