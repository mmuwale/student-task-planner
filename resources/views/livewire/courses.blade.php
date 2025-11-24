<div class="container" style="max-width: 900px; margin: 0 auto; padding: 32px 0;">
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
        {{-- Floating Form Card --}}
        <div class="card" style="background: #f8f4eb; border-radius: 20px; box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1); border: 1px solid rgba(241, 230, 210, 0.3); margin-bottom: 32px; position: relative; z-index: 10;">
            <div class="card-body" style="padding: 32px;">
                <h2 class="card-title" style="font-size: 20px; font-weight: 800; color: #210706; margin-bottom: 24px;">
                    {{ $isEditing ? 'Edit' : 'Add' }} Course
                </h2>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; color: #891d1a;">Course Name</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter course name" style="border-radius: 12px; background: #f8f9fa; border: 1px solid #e8f0f2; font-size: 15px; padding: 8px 16px;">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn" style="border-radius: 12px; background: linear-gradient(135deg, #891d1a 0%, #a82a26 100%); color: #fff; font-weight: 700; padding: 8px 24px; border: none; box-shadow: 0 4px 16px rgba(137,29,26,0.08); transition: background 0.2s;">{{ $isEditing ? 'Update Course' : 'Add Course' }}</button>
                        <button type="button" wire:click="cancel" class="btn btn-outline-secondary" style="border-radius: 12px; font-weight: 700; background: #fff; color: #891d1a; border: 1px solid #891d1a; padding: 8px 24px;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 32px;">
            <h2 class="card-title" style="font-size: 24px; font-weight: 800; color: #210706; letter-spacing: 0.5px; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-book" style="color: #210706; font-size: 24px;"></i>
                My Courses
            </h2>
            <div class="d-flex gap-2" style="align-items: center; margin-left: auto; justify-content: flex-end; min-width: 340px;">
                <input type="text" wire:model.live.debounce.300ms="search" class="form-control" style="width: 200px; border-radius: 12px; background: #f8f9fa; border: 1px solid #e8f0f2; font-size: 15px; padding: 8px 16px;" placeholder="Search courses...">
                <button wire:click="create" class="btn" style="border-radius: 12px; background: linear-gradient(180deg, #210706 0%, #391016 100%); color: #f0f6f7; font-weight: 700; padding: 8px 24px; border: none; box-shadow: 0 4px 16px rgba(137,29,26,0.08); transition: background 0.2s;">
                    <i class="fas fa-plus" style="margin-right: 8px;"></i> Add New Course
                </button>
            </div>
        </div>
        <div class="row" style="display: flex; flex-wrap: wrap; gap: 24px;">
            @php $openDropdown = request()->get('openDropdown'); @endphp
            @forelse($courses as $course)
                <div class="col-md-5" style="flex: 1 1 320px; max-width: 420px; min-width: 320px;">
                    <div class="card course-card" style="background: linear-gradient(180deg, #210706 0%, #391016 100%); border-radius: 16px; box-shadow: 0 16px 48px rgba(137, 29, 26, 0.12); border: 1px solid rgba(241, 230, 210, 0.5); position: relative; transition: box-shadow 0.3s, transform 0.3s; cursor: pointer;">
                        <div class="card-body" style="padding: 24px 20px 20px 20px; position: relative;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div style="flex:1;">
                                    <h4 style="font-weight: 700; color: #f0f6f7; margin-bottom: 8px; font-size: 20px;">{{ $course->name }}</h4>
                                    <div style="margin-bottom: 8px;">
                                        <span style="background: #f8f4eb; color: #891d1a; font-size: 15px; font-weight: 700; border-radius: 10px; padding: 6px 16px; display: inline-block;">
                                            {{ $course->tasks_remaining ?? '0' }} tasks remaining
                                        </span>
                                    </div>
                                    <div style="color: #f1e6d2; font-size: 13px;">Created: {{ $course->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="course-dropdown-wrapper" style="position: relative;">
                                    <button class="btn" type="button" style="border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 20px; background: #f8f9fa; color: #891d1a; border: none; box-shadow: 0 2px 8px rgba(137,29,26,0.08);" onclick="toggleCourseDropdown({{ $course->id }})">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="course-dropdown avatar-dropdown" id="courseDropdown{{ $course->id }}" style="display: none; position: absolute; top: 40px; right: 0; background: #fff; border-radius: 12px; box-shadow: 0 8px 32px rgba(137, 29, 26, 0.15); min-width: 160px; z-index: 1001; border: 1px solid #f1e6d2; overflow: hidden;">
                                        <a href="#" class="dropdown-item" style="display: block; padding: 14px 20px; color: #210706; text-decoration: none; font-weight: 600; border-bottom: 1px solid #f1e6d2; transition: background 0.2s;" wire:click.prevent="edit({{ $course->id }})">Edit</a>
                                        <a href="#" class="dropdown-item text-danger" style="display: block; padding: 14px 20px; color: #891d1a; text-decoration: none; font-weight: 600; transition: background 0.2s;" wire:click.prevent="destroy({{ $course->id }})">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card" style="background: linear-gradient(180deg, #210706 0%, #391016 100%); border-radius: 16px; box-shadow: 0 16px 48px rgba(137, 29, 26, 0.12); border: 1px solid rgba(241, 230, 210, 0.5);">
                        <div class="card-body text-center" style="padding: 32px; color: #f0f6f7; font-weight: 600;">
                            No courses found
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <script>
            function toggleCourseDropdown(id) {
                document.querySelectorAll('.course-dropdown').forEach(function(drop) {
                    drop.style.display = 'none';
                });
                var dropdown = document.getElementById('courseDropdown' + id);
                if(dropdown) {
                    dropdown.style.display = 'block';
                }
            }
            document.addEventListener('click', function(e) {
                document.querySelectorAll('.course-dropdown').forEach(function(drop) {
                    if (!e.target.closest('.course-dropdown-wrapper')) {
                        drop.style.display = 'none';
                    }
                });
            });
            document.addEventListener('keydown', function(e) {
                if(e.key === 'Escape') {
                    document.querySelectorAll('.course-dropdown').forEach(function(drop) {
                        drop.style.display = 'none';
                    });
                }
            });
        </script>
    @endif
</div>