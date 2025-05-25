<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // List & Create Permission

    public function openPermissionsPage()
    {
        $permissions = Permission::latest()->paginate(5);
        return view('permissions.openPermissionsPage', compact('permissions'));
    }
    public function openCreatePermissionsPage()
    {
        return view('permissions.openCreatePermissionsPage');
    }
    public function storePermissions(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created!');
    }

    public function editPermissionPage($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.editPermissionPage', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|unique:permissions,name,' . $id]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission updated.');
    }



    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);

        // Remove from all roles
        $permission->roles()->detach();
        // Optional: remove from all users if used directly
        // $permission->users()->detach();
        $permission->delete();

        return back()->with('success', 'Permission deleted and removed from all roles.');
    }
}
