@extends('layouts.app')

@section('title', 'Edit Settings')
@section('page-title', 'Edit Settings')
@section('content')
<div class="card">
    <h2>Edit Settings</h2>
    <form>
        <!-- Add your form fields here -->
        <div class="form-group">
            <label for="setting-name">Setting Name</label>
            <input type="text" id="setting-name" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="setting-value">Value</label>
            <input type="text" id="setting-value" name="value" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
