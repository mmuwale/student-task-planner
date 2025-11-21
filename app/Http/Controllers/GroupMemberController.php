<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    public function index()
    {
        return GroupMember::with('studyGroup')->get();
    }

    public function store(Request $request)
    {
        return GroupMember::create($request->all());
    }

    public function show(GroupMember $groupMember)
    {
        return $groupMember->load('studyGroup');
    }

    public function update(Request $request, GroupMember $groupMember)
    {
        $groupMember->update($request->all());
        return $groupMember;
    }

    public function destroy(GroupMember $groupMember)
    {
        $groupMember->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
