@extends('layouts.app')

@section('title', 'Create Study Group')
@section('page-title', 'Create Study Group')
@section('content')
<div class="card">
    <h2>Create Study Group</h2>
    <form>
        <!-- Add your form fields here -->
        <div class="form-group">
            <label for="group-name">Group Name</label>
            <input type="text" id="group-name" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="group-description">Description</label>
            <textarea id="group-description" name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Group</button>
    </form>
</div>
@endsection
