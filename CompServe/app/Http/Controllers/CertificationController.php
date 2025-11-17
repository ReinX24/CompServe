<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Auth::user()->certifications()->latest()->get();
        return view('freelancer.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('freelancer.certifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048'
        ]);

        $path = $request->file('document')->store('certifications');

        Certification::create([
            'freelancer_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description,
            'document_path' => $path,
        ]);

        return redirect()->route('freelancer.certifications.index')
            ->with('success', 'Certification submitted for verification.');
    }
}
