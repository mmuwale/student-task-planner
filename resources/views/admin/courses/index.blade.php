[file name]: courses-index.blade.php
[file content begin]
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management - Student Task Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f0f6f7 0%, #e8f0f2 100%);
            min-height: 100vh;
            padding: 24px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            padding: 16px 24px;
            background: linear-gradient(135deg, #891d1a 0%, #a82a26 100%);
            border-radius: 16px;
            color: #f0f6f7;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #3d1f2e;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1);
            border: 1px solid rgba(241, 230, 210, 0.3);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #f8f9fa;
            padding: 16px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #3d1f2e;
        }

        .table td {
            padding: 16px;
            border-bottom: 1px solid #dee2e6;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <h1 style="margin: 0; font-size: 1.5rem;">Student Task Planner - Admin</h1>
            </div>
            <div style="display: flex; gap: 16px;">
                <a href="{{ route('dashboard') }}" style="color: #f0f6f7; text-decoration: none; font-weight: 600;">Dashboard</a>
                <a href="{{ route('courses.index') }}" style="color: #f0f6f7; text-decoration: none; font-weight: 600; background: rgba(241, 230, 210, 0.2); padding: 8px 16px; border-radius: 8px;">Courses</a>
                <a href="{{ route('admin.users.index') }}" style="color: #f0f6f7; text-decoration: none; font-weight: 600;">Users</a>
            </div>
        </div>

        <!-- Main Content -->
        <div>
            <h2 class="page-title">
                Course Management
                <a href="{{ route('courses.create') }}" class="btn btn-success">Add New Course</a>
            </h2>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Instructor</th>
                            <th>Credits</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->instructor }}</td>
                            <td>{{ $course->credits }}</td>
                            <td>{{ Str::limit($course->description, 50) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this course?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @if($courses->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #6c757d;">
                                No courses found. <a href="{{ route('courses.create') }}">Create the first course</a>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

