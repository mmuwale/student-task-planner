@extends('layouts.app')

@section('title', 'Create Project')
@section('page-title', 'Create Project')
@section('content')
<div class="card">
    <h2>Create Project</h2>
    <form>
        <!-- Add your form fields here -->
        <div class="form-group">
            <label for="project-title">Project Title</label>
            <input type="text" id="project-title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="project-description">Description</label>
            <textarea id="project-description" name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>
@endsection
