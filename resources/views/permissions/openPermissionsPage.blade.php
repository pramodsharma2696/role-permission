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
            <h2 class="text-2xl font-semibold mb-4">Permissions List</h2>
             <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create Permission</a>
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
                        @forelse($permissions as $index => $permission)
                        <tr>
                            <th scope="row">{{ $permissions->firstitem() + $index}}</th>
                            <td>{{$permission->name}}</td>
                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                             <td>
                                @can('edit')
                                <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                @endcan
                                 @can('delete')
                                <a href="{{ route('permission.delete', $permission->id) }}" class="btn btn-danger btn-sm">Remove</a>
                                 @endcan
                            </td>
                            <!-- <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/Y') }}</td> -->
                           
                        </tr>
                       @empty

                       @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>