<?php

namespace App\Http\Controllers;

use App\Models\ZoomMeeting;
use Illuminate\Http\Request;

class ZoomMeetingController extends Controller
{
    public function index()
    {
        return ZoomMeeting::with('course')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string',
            'mentor_name' => 'required|string',
            'scheduled_at' => 'required|date',
            'zoom_link' => 'required|url',
            'meeting_id' => 'nullable|string',
            'passcode' => 'nullable|string',
        ]);

        $meeting = ZoomMeeting::create($validated);

        return response()->json($meeting, 201);
    }

    public function show(ZoomMeeting $zoomMeeting)
    {
        return $zoomMeeting->load('course');
    }

    public function update(Request $request, ZoomMeeting $zoomMeeting)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'mentor_name' => 'sometimes|string',
            'scheduled_at' => 'sometimes|date',
            'zoom_link' => 'sometimes|url',
            'meeting_id' => 'nullable|string',
            'passcode' => 'nullable|string',
        ]);

        $zoomMeeting->update($validated);

        return response()->json($zoomMeeting);
    }

    public function destroy(ZoomMeeting $zoomMeeting)
    {
        $zoomMeeting->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
