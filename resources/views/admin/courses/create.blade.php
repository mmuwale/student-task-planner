
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Student Task Planner</title>
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
        }

        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 12px 40px rgba(137, 29, 26, 0.1);
            border: 1px solid rgba(241, 230, 210, 0.3);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #3d1f2e;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #891d1a;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
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

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 4px;
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
            <h2 class="page-title">Create New Course</h2>

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
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="title">Course Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="instructor">Instructor</label>
                        <input type="text" class="form-control" id="instructor" name="instructor" value="{{ old('instructor') }}" required>
                        @error('instructor')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="credits">Credits</label>
                        <input type="number" class="form-control" id="credits" name="credits" value="{{ old('credits') }}" min="1" max="10" required>
                        @error('credits')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Create Course</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
