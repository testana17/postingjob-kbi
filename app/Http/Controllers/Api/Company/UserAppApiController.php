<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class UserAppApiController extends Controller
{
    public function index()
    {
        $applications = Application::with('user', 'job')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Daftar aplikasi berhasil diambil',
            'data' => $applications
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);
    
        $application = Application::findOrFail($id);
    
        // Gunakan trim() untuk memastikan input bersih
        $status = trim($request->status);
    
        $application->update(['status' => $status]);
    
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'data' => $application
        ]);
    }
    
}
