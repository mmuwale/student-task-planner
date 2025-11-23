<div class="col-md-8 mx-auto mt-5">
    {{-- Messages --}}
    @foreach (['success', 'error', 'message'] as $msg)
        @if (session()->has($msg))
            <div class="alert alert-{{ $msg === 'error' ? 'danger' : ($msg === 'message' ? 'info' : 'success') }} alert-dismissible fade show" role="alert">
                {{ session($msg) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    @if($showForm)
        {{-- Form Card --}}
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <h5 class="card-title mb-4">{{ $isEditing ? 'Edit' : 'Add' }} Course</h5>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter course name">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter course description"></textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger flex-fill">{{ $isEditing ? 'Update Course' : 'Add Course' }}</button>
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary flex-fill">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        {{-- Table Card --}}
        <div class="card shadow-sm rounded-3 mt-3">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <h5 class="mb-0">All Courses</h5>
                    <div class="d-flex gap-2">
                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control" style="width: 200px;" placeholder="Search...">
                        <button wire:click="create" class="btn btn-danger">Add New</button>
                    </div>
                </div>
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description ?? 'No description' }}</td>
                                <td>{{ $course->created_at->format('M d, Y') }}</td>
                                <td class="d-flex gap-1">
                                    <button wire:click="edit({{ $course->id }})" class="btn btn-sm btn-outline-danger">Edit</button>
                                    <button wire:click="destroy({{ $course->id }})" class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No courses found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
