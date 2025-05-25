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
               <form action="{{ route('permission.update', $permission->id) }}" method="post">
                @csrf 
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter role name" name="name" value="{{ $permission->name }}">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Permission</button>
                     <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>
                </div>
               </form>



            </div>
        </div>
    </div>
</x-app-layout>
