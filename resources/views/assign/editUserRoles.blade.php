<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <h2 class="text-xl mb-4">Edit Roles for User: <strong>{{ $user->name }}</strong></h2>
                <form method="POST" action="{{ route('user.roles.update', $user->id) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        @foreach($roles as $role)
                        <div class="form-check">
                             @if($role->name !== 'Super Admin')
                            <input class="form-check-input" type="checkbox" name="role_ids[]" value="{{ $role->id }}"
                                {{ in_array($role->id, $assigned) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $role->name }}</label>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('assign.role.to.user.list') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


