<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <h2 class="text-2xl font-semibold mb-4">Role List</h2>

                <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Roles</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">CreatedAt</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $index => $role)
                        <tr>
                            <th scope="row">{{ $roles->firstitem() + $index}}</th>
                            <td>{{$role->name}}</td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>

                            <td>
                                @if($role->name !== 'Super Admin')
                                @can('update', $role)
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                @endcan
                                @can('delete', $role)
                                <a href="{{ route('role.delete', $role->id) }}" class="btn btn-danger btn-sm">Remove</a>
                                @endcan
                                @endif
                            </td>
                            <!-- <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y') }}</td> -->

                        </tr>
                        @empty

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>