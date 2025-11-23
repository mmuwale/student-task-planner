@extends('layouts.app')

@section('title', 'Study Group')
@section('page-title', 'Study Group')
@section('content')
<div class="card" style="width: 100%; max-width: 900px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Study Group</h2>
    <form method="POST" action="#" style="margin-bottom: 32px;">
        @csrf
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label for="member-name" style="font-weight: 600; color: #683844;">Member Name</label>
                <input type="text" id="member-name" name="name" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label for="member-role" style="font-weight: 600; color: #683844;">Role</label>
                <input type="text" id="member-role" name="role" class="form-control" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
            </div>
            <button type="submit" style="margin-top: 12px; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Add Member</button>
        </div>
    </form>
    <div style="margin-top: 24px; flex: 1;">
        <table style="width: 100%; border-collapse: collapse; background: #f9f2e8; border-radius: 12px; overflow: hidden;">
            <thead>
                <tr style="background: #ceb2bd; color: #2a1520;">
                    <th style="padding: 12px; text-align: left;">Name</th>
                    <th style="padding: 12px; text-align: left;">Role</th>
                    <th style="padding: 12px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Example: Replace with your actual group members from the database
                    $members = [
                        ['name' => 'Alice Johnson', 'role' => 'Leader'],
                        ['name' => 'Bob Smith', 'role' => 'Member'],
                    ];
                @endphp
                @forelse($members as $member)
                    <tr style="border-bottom: 1px solid #e8dcd0;">
                        <td style="padding: 12px;">{{ $member['name'] }}</td>
                        <td style="padding: 12px;">{{ $member['role'] }}</td>
                        <td style="padding: 12px;">
                            <button style="background: #c85a54; color: #fff; border: none; border-radius: 6px; padding: 6px 14px; font-size: 14px; cursor: pointer;">Edit</button>
                            <button style="background: #683844; color: #fff; border: none; border-radius: 6px; padding: 6px 14px; font-size: 14px; cursor: pointer; margin-left: 8px;">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 24px; color: #8b6f63; text-align: center;">No group members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
