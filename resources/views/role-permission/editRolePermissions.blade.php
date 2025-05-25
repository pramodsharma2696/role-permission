<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <h2 class="text-xl mb-4">Edit Permissions for Role: <strong>{{ $role->name }}</strong></h2>
                <form method="POST" action="{{ route('role.permissions.update', $role->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permission_ids[]" value="{{ $permission->id }}"
                                {{ in_array($permission->id, $assigned) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('assign.permission.to.role') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>