@extends('layouts.app')

@section('title', 'Reminders')
@section('page-title', 'Reminders')
@section('content')
<div class="card" style="width: 100%; max-width: 900px; min-height: 350px; margin: 48px auto; display: flex; flex-direction: column; justify-content: flex-start;">
    <h2 style="margin-bottom: 24px; color: #3d1f2e;">Reminders</h2>
    <div style="margin-top: 24px; flex: 1;">
        <table style="width: 100%; border-collapse: collapse; background: #f9f2e8; border-radius: 12px; overflow: hidden;">
            <thead>
                <tr style="background: #ceb2bd; color: #2a1520;">
                    <th style="padding: 12px; text-align: left;">Subject</th>
                    <th style="padding: 12px; text-align: left;">Message</th>
                    <th style="padding: 12px; text-align: left;">Sent At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reminders as $reminder)
                    <tr style="border-bottom: 1px solid #e8dcd0;">
                        <td style="padding: 12px;">{{ $reminder->subject ?? '-' }}</td>
                        <td style="padding: 12px;">{{ $reminder->message ?? '-' }}</td>
                        <td style="padding: 12px;">{{ $reminder->created_at ? $reminder->created_at->format('Y-m-d H:i') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 24px; color: #8b6f63; text-align: center;">No reminders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
