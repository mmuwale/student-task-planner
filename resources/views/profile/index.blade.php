@extends('layouts.app')

@section('title', 'Profile')
@section('content')
<div style="max-width: 500px; margin: 60px auto; background: #f5e6d3; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); padding: 40px 32px;">
    <h2 style="text-align: center; color: #3d1f2e; margin-bottom: 32px;">My Profile</h2>
    <button id="toggleProfileForm" style="width: 100%; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 16px; font-weight: 600; cursor: pointer; margin-bottom: 18px; transition: background 0.2s;">Edit Profile &#9660;</button>
    <div id="profileFormContainer" style="display: none;">
        <form method="POST" action="#">
            @csrf
            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Name</label>
                <input type="text" id="name" name="name" value="John Doe" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Email</label>
                <input type="email" id="email" name="email" value="john@example.com" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <div style="margin-bottom: 28px;">
                <label for="password" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Change Password</label>
                <input type="password" id="password" name="password" placeholder="New password" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <button type="submit" style="width: 100%; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 14px 0; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Save Changes</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleProfileForm');
        const formContainer = document.getElementById('profileFormContainer');
        let open = false;
        toggleBtn.addEventListener('click', function() {
            open = !open;
            formContainer.style.display = open ? 'block' : 'none';
            toggleBtn.innerHTML = open ? 'Hide Profile &#9650;' : 'Edit Profile &#9660;';
        });
    });
</script>
@endsection
