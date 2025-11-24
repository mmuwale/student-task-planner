<div x-show="{{ $modalVar }}"
     x-cloak
     class="fixed inset-0 z-40 flex items-center justify-center bg-black/40">

    <div @click.outside="{{ $modalVar }} = false"
         class="w-full max-w-md bg-[#f7ecf0] border border-[#e0c1cd] rounded-lg shadow-lg text-xs">

        {{-- HEADER --}}
        <div class="flex items-center justify-between px-4 py-2 border-b border-[#e0c1cd]">
            <h3 class="text-sm font-semibold text-slate-800">Add New Task</h3>
            <button @click="{{ $modalVar }} = false"
                    class="text-slate-500 text-lg leading-none">&times;</button>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('tasks.store') }}" class="p-4 space-y-3">
            @csrf

            {{-- TITLE --}}
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Task Name</label>
                <input type="text" name="title" required
                       class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-[12px] 
                              focus:outline-none focus:ring-2 focus:ring-[#800020]/60">
            </div>

            {{-- COURSE + DUE DATE --}}
            <div class="grid grid-cols-2 gap-3">
                {{-- COURSE --}}
                <div>
                    <label class="block mb-1 font-semibold text-[11px] text-slate-700">Course</label>
                    <select name="course_id" required
                            class="w-full border border-[#d2aabb] rounded-md px-2 py-2 text-[12px]">
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- DUE DATE --}}
                <div>
                    <label class="block mb-1 font-semibold text-[11px] text-slate-700">Due Date</label>
                    <input type="date" name="due_date" required
                           class="w-full border border-[#d2aabb] rounded-md px-2 py-2 text-[12px]">
                </div>
            </div>

            {{-- PRIORITY + STATUS --}}
            <div class="grid grid-cols-2 gap-3">
                {{-- PRIORITY --}}
                <div>
                    <label class="block mb-1 font-semibold text-[11px] text-slate-700">Priority</label>
                    <select name="priority"
                            class="w-full border border-[#d2aabb] rounded-md px-2 py-2 text-[12px]">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                {{-- STATUS (MUST match controller validation) --}}
                <div>
                    <label class="block mb-1 font-semibold text-[11px] text-slate-700">Status</label>
                    <select name="status"
                            class="w-full border border-[#d2aabb] rounded-md px-2 py-2 text-[12px]">
                        <option value="todo" selected>To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            {{-- NOTES -> maps to "description" --}}
            <div>
                <label class="block mb-1 font-semibold text-[11px] text-slate-700">Notes</label>
                <textarea name="description" rows="2"
                          class="w-full border border-[#d2aabb] rounded-md px-3 py-2 text-[12px]"></textarea>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end gap-2 pt-2">
                <button type="button"
                        @click="{{ $modalVar }} = false"
                        class="px-3 py-1.5 rounded-md border border-[#d2aabb] 
                               text-[11px] text-slate-700 hover:bg-slate-50">
                    Cancel
                </button>

                <button type="submit"
                        class="px-3 py-1.5 rounded-md bg-[#800020] text-white text-[11px] 
                               font-semibold hover:bg-[#5e0617]">
                    Add Task
                </button>
            </div>
        </form>

    </div>
</div>
