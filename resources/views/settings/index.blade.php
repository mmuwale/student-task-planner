@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('content')
<div class="card" style="width: 100%; max-width: 800px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Settings</h2>
    <form style="margin-top: 24px; flex: 1; color: #3d1f2e;" method="POST" action="#">
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
                <option value="off">Off</option>
                <option value="email">Email</option>
            </select>
        </div>
        <!-- Notification Preferences -->
        <h3 style="margin-bottom: 12px; color: #6b3d4d;">Notification Preferences</h3>
        <div style="margin-bottom: 28px;">
            <label style="display: block; margin-bottom: 6px;">Receive notifications via:</label>
            <div style="display: flex; gap: 16px;">
                <label><input type="checkbox" name="notify_email" checked> Email</label>
            </div>
        </div>
        <!-- Language -->
        
        <!-- Account Actions -->
        <h3 style="margin-bottom: 12px; color: #6b3d4d;">Account Actions</h3>
        <div style="margin-bottom: 20px; display: flex; gap: 16px;">
            <button type="button" style="background: #e8dcd0; color: #3d1f2e; border: none; border-radius: 6px; padding: 8px 18px; font-size: 15px; cursor: pointer;">Deactivate Account</button>
            <button type="button" style="background: #c0392b; color: #fff; border: none; border-radius: 6px; padding: 8px 18px; font-size: 15px; cursor: pointer;">Delete Account</button>
        </div>
        <button type="submit" style="background: #ceb2bd; color: #fff; border: none; border-radius: 6px; padding: 10px 24px; font-size: 16px; cursor: pointer; margin-top: 16px;">Save Changes</button>
    </form>
</div>
@endsection
