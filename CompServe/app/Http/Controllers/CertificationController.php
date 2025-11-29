<?php

namespace App\Http\Controllers;

use App\Mail\CertificationStatusChanged;
use Auth;
use App\Models\Certification;
use Illuminate\Http\Request;
use Mail;

class CertificationController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === "freelancer") {
            $certifications = Auth::user()->certifications()->latest()->get();
            return view('freelancer.certifications.index', compact('certifications'));
        } else if (Auth::user()->role === "admin") {
            $certifications = Certification::latest()->paginate(6);
            return view('admin.certifications', compact('certifications'));
        }
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
            'document' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120'
        ]);

        $path = $request->file('document')->store('certifications', 'public');

        Certification::create([
            'freelancer_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description,
            'document_path' => $path,
        ]);

        return redirect()->route('freelancer.certifications.index')
            ->with('success', 'Certification submitted for verification.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $cert = Certification::findOrFail($id);
        $cert->status = $request->status;
        $cert->save();

        // Send email to the user
        Mail::to($cert->freelancer->email)
            ->queue(new CertificationStatusChanged(
                $cert,
                $cert->status
            ));

        return back()->with('success', 'Certification status updated to ' . $request->status);
    }

    // Approve and reject methods for admin
    public function approve($id)
    {
        $cert = Certification::findOrFail($id);
        $cert->update(['status' => 'approved']);

        // Send email to the user
        Mail::to($cert->freelancer->email)
            ->queue(new CertificationStatusChanged(
                $cert,
                'approved'
            ));

        return back()->with('success', 'Certification approved.');
    }

    public function reject($id)
    {
        $cert = Certification::findOrFail($id);
        $cert->update(['status' => 'rejected']);

        // Send email to the user
        Mail::to($cert->freelancer->email)
            ->queue(new CertificationStatusChanged(
                $cert,
                'rejected'
            ));

        return back()->with('success', 'Certification rejected.');
    }
}
