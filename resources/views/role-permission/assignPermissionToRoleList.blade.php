<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Roles and Their Permissions</h2>
                <a href="{{ route('create.permission.to.role') }}" class="btn btn-primary mb-3">Assign Permission To Role</a>
                <table class="table table-bordered table-striped w-full">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissionsToRoles as $index => $role)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->permissions->count())
                                       
                                            @foreach ($role->permissions as $permission)
                                                 <span class="badge bg-info text-dark me-1">{{ $permission->name }}</span>
                                            @endforeach
                                        
                                    @else
                                        <em>No permissions assigned</em>
                                    @endif
                                </td>
                                <td>
                                    @can('update', $role)
                                    <a href="{{ route('role.permissions.edit', $role->id) }}"class="btn btn-primary btn-sm">Edit</a>
                                    @endcan
                                    <form action="{{ route('role.permissions.revoke', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button onclick="return confirm('Revoke all permissions?')" class="btn btn-sm btn-danger">Revoke All Permissions</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
