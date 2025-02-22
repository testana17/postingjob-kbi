<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobUser;
use Illuminate\Support\Facades\Auth;

class UserApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'job'])
        ->whereIn('job_id', JobUser::where('users_id', auth()->id())->pluck('id'))
        ->paginate(10);
    
    
        // dd($applications); // Cek hasilnya di browser
    
        return view('company.application', compact('applications'));
    }
    
    


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application = Application::findOrFail($id);
        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}
