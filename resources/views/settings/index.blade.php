@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('content')
<div class="card" style="width: 100%; max-width: 800px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Settings</h2>
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 16px; border-radius: 5px; border: 1px solid #c3e6cb; text-align: center;">
            {{ session('success') }}
        </div>
    @endif
    <form style="margin-top: 24px; flex: 1; color: #3d1f2e;" method="POST" action="{{ route('settings.update') }}">
        @csrf
        <!-- Security Section -->
        <h3 style="margin-bottom: 12px; color: #6b3d4d;">Account Security</h3>
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 6px;">Change Password</label>
            <input type="password" id="password" name="password" placeholder="New password" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ceb2bd;">
        </div>
        <div style="margin-bottom: 28px;">
            <label for="2fa" style="display: block; margin-bottom: 6px;">Two-Factor Authentication</label>
            <select id="2fa" name="2fa" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ceb2bd;">
                <option value="off" {{ (auth()->user()->two_factor ?? 'off') === 'off' ? 'selected' : '' }}>Off</option>
                <option value="email" {{ (auth()->user()->two_factor ?? 'off') === 'email' ? 'selected' : '' }}>Email</option>
            </select>
        </div>
        <!-- Notification Preferences -->
        <h3 style="margin-bottom: 12px; color: #6b3d4d;">Notification Preferences</h3>
        <div style="margin-bottom: 28px;">
            <label style="display: block; margin-bottom: 6px;">Receive notifications via:</label>
            <div style="display: flex; gap: 16px;">
                <label><input type="checkbox" name="notify_email" {{ auth()->user()->notify_email ? 'checked' : '' }}> Email</label>
            </div>
        </div>
        <!-- Language -->
        
        <!-- Account Actions -->
        <h3 style="margin-bottom: 12px; color: #6b3d4d;">Account Actions</h3>
        <div style="margin-bottom: 20px; display: flex; gap: 16px;">
            <button type="button" style="background: #e8dcd0; color: #3d1f2e; border: none; border-radius: 6px; padding: 8px 18px; font-size: 15px; cursor: pointer;">Deactivate Account</button>
            <button type="button" style="background: #c0392b; color: #fff; border: none; border-radius: 6px; padding: 8px 18px; font-size: 15px; cursor: pointer;">Delete Account</button>
        </div>
        <button id="saveChangesBtn" type="submit" style="background: #3d1f2e; color: #fff; border: none; border-radius: 6px; padding: 10px 24px; font-size: 16px; cursor: pointer; margin-top: 16px; transition: background 0.2s;">Save Changes</button>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const saveBtn = document.getElementById('saveChangesBtn');
        let changed = false;
        if (form && saveBtn) {
            // Listen to all input, select, and textarea changes
            const fields = form.querySelectorAll('input, select, textarea');
            fields.forEach(field => {
                field.addEventListener('input', function() {
                    saveBtn.style.background = '#1a7d2b'; // green for changed
                    saveBtn.style.color = '#fff';
                    changed = true;
                });
                field.addEventListener('change', function() {
                    saveBtn.style.background = '#1a7d2b';
                    saveBtn.style.color = '#fff';
                    changed = true;
                });
            });
            form.addEventListener('reset', function() {
                saveBtn.style.background = '#ceb2bd';
                saveBtn.style.color = '#fff';
                changed = false;
            });
            // Success message now handled by Laravel session flash
        }
    });
    </script>
    </form>
</div>
@endsection
