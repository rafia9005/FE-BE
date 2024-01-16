<?php

namespace App\Http\Controllers;

use App\Http\Resources\SchenduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = Schedule::all();

        return SchenduleResource::collection($schedule);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bus' => 'required|string',
            'line' => 'required|string',
            'kelas' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            // 'berangkat' => 'required|date_format:Y-m-d H:i:s',
            'berangkat' => 'required|string',
            'datang' => 'required|string',
            'jarak' => 'required|string',
            'speed' => 'required|string',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $schedule = new Schedule();

        $schedule->bus = $request->bus;
        $schedule->line = $request->line;
        $schedule->kelas = $request->kelas;
        $schedule->from = $request->from;
        $schedule->to = $request->to;
        $schedule->berangkat = $request->berangkat;
        $schedule->datang = $request->datang;
        $schedule->jarak = $request->jarak;
        $schedule->speed = $request->speed;

        $schedule->save();

        return response()->json(['message' => 'Schedule created successfully', 'data' => $schedule], 201);
    }
    public function delete(Request $request, $id)
    {
        $schedule = Schedule::find($id);


        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->delete();
        return response()->json(['message' => 'Schedule deleted successfully']);
    }
    public function show(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        return new SchenduleResource($schedule);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bus' => 'required|string',
            'line' => 'required|string',
            'kelas' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            // 'berangkat' => 'required|date_format:Y-m-d H:i:s',
            'berangkat' => 'required|string',
            'datang' => 'required|string',
            'jarak' => 'required|string',
            'speed' => 'required|string',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->bus = $request->bus;
        $schedule->line = $request->line;
        $schedule->kelas = $request->kelas;
        $schedule->from = $request->from;
        $schedule->to = $request->to;
        $schedule->berangkat = $request->berangkat;
        $schedule->datang = $request->datang;
        $schedule->jarak = $request->jarak;
        $schedule->speed = $request->speed;
        $schedule->update();

        return new SchenduleResource($schedule);
    }
}
