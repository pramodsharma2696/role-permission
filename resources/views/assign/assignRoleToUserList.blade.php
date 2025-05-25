<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="bg-white p-4 shadow sm:rounded-lg">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="text-2xl font-semibold mb-4">User and their Roles</h2>
                    <a href="{{ route('assign.role.to.user.create') }}" class="btn btn-primary">Assign Role to User</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->roles as $role)
                                <span class="badge bg-success">{{ $role->name }}</span>
                                @empty
                                <span class="text-muted">No role assigned</span>
                                @endforelse
                            </td>
                            <td>
                                @if (!$user->hasRole('Super Admin'))
                                <a href="{{ route('user.roles.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('user.roles.revoke', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button onclick="return confirm('Revoke all roles from user?')" class="btn btn-sm btn-danger">Revoke All</button>
                                </form>
                                @else
                                <span class="badge bg-secondary">Super Admin - Protected</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>