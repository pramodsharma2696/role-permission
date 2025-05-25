<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    // List & Create role

    public function openRolePage()
    {
        $roles = Role::latest()->paginate(5);
        return view('roles.openRolePage', compact('roles'));
    }
    public function openCreateRolePage()
    {
        return view('roles.openCreateRolePage');
    }
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created!');
    }

    public function editRolePage($id)
    {
        $role = Role::findOrFail($id);
        $this->authorize('edit', $role);
        return view('roles.editRolePage', compact('role'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|unique:roles,name,' . $id]);

        $role = Role::findOrFail($id);
        $this->authorize('update', $role);
        $role->name = $request->name;
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role updated.');
    }



    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
         $this->authorize('delete', $role);
        // Remove all assigned permissions
        $role->permissions()->detach();

        // Optional: remove role from users
        $role->users()->detach();

        $role->delete();

        return back()->with('success', 'Role deleted and detached from all permissions and users.');
    }
}
