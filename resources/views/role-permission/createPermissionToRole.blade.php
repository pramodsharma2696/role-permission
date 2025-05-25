<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <form action="{{ route('store.permission.to.role') }}" method="post">
                    @csrf 
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Select Role</label>
                        <select class="form-select" name="role_id" required>
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Select Permissions</label>
                        <div class="border p-2 rounded" style="max-height: 200px; overflow-y: auto;">
                            @forelse($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission_ids[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @empty
                                <p>No permissions found.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Assign Permissions</button>
                        <a href="{{ route('assign.permission.to.role') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
