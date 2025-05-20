<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentRegistrationController extends Controller
{
    public function showForm()
    {
        return view('parent.register');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_email' => 'nullable|email|max:255',
        ]);

        $data = $request->only([
            'name', 'birth_date', 'gender', 'address', 'parent_name', 'parent_phone', 'parent_email'
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('student-photos', 'public');
        }
        $data['user_id'] = Auth::id();
        $data['registration_date'] = now();
        $data['status'] = 'pending';
        Registration::create($data);

        return redirect()->route('parent.dashboard')->with('success', 'Pendaftaran anak berhasil dikirim.');
    }
}
