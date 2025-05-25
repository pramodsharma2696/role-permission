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
            <div class="bg-white p-4 shadow sm:rounded-lg">
                <h2 class="text-xl font-bold mb-4">Assign Role to User</h2>

                <form action="{{ route('assign.role.to.user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id">Select User</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Select Roles</label>
                        <div class="border p-3 rounded" style="max-height: 200px; overflow-y: auto;">
                            @foreach ($roles as $role)
                                @if($role->name !== 'Super Admin')
                                <div class="form-check">
                                    <input type="checkbox" name="role_ids[]" value="{{ $role->id }}" class="form-check-input" id="role_{{ $role->id }}">
                                    <label for="role_{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Assign Roles</button>
                    <a href="{{ route('assign.role.to.user.list') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
