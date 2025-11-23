<div class="header">
    <div class="nav">
        <a href="#">Courses</a>
        <a href="#">Tasks</a>
    </div>
    <div style="position: relative;">
        <a href="#" id="profileDropdownBtn" class="user-menu" style="border-bottom:none !important;padding-bottom:0 !important;text-decoration:none !important;display: flex; align-items: center; gap: 8px;">
            <span>Profile</span>
            <span id="profileIcon" style="display: inline-block; transition: transform 0.2s;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="7" r="4" fill="#683844"/>
                    <ellipse cx="10" cy="15.5" rx="6.5" ry="3.5" fill="#ceb2bd"/>
                </svg>
            </span>
        </a>
        <div id="profileDropdown" style="display: none; position: absolute; right: 0; top: 100%; background: #f5e6d3; border-radius: 10px; box-shadow: 0 4px 16px rgba(0,0,0,0.10); padding: 24px 20px; min-width: 260px; z-index: 1001;">
            <form method="POST" action="#">
                @csrf
                <div style="margin-bottom: 16px;">
                    <label for="name" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Name</label>
                    <input type="text" id="name" name="name" value="John Doe" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 14px;">
                </div>
                <div style="margin-bottom: 16px;">
                    <label for="email" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Email</label>
                    <input type="email" id="email" name="email" value="john@example.com" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 14px;">
                </div>
                <div style="margin-bottom: 18px;">
                    <label for="password" style="display: block; color: #683844; font-weight: 600; margin-bottom: 6px;">Change Password</label>
                    <input type="password" id="password" name="password" placeholder="New password" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 14px;">
                </div>
                <button type="submit" style="width: 100%; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Save Changes</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('profileDropdownBtn');
        const dropdown = document.getElementById('profileDropdown');
        const icon = document.getElementById('profileIcon');
        let open = false;
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            open = !open;
            dropdown.style.display = open ? 'block' : 'none';
            icon.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
        });
        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
                open = false;
            }
        });
    });
</script>
