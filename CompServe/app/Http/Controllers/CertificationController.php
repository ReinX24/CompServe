<?php

namespace App\Http\Controllers;

use App\Mail\CertificationStatusChanged;
use Auth;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'custom_certification' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120'
        ]);

        // Use custom certification name if "other" was selected
        if ($validated['type'] === 'other') {
            $validated['type'] = $validated['custom_certification'];
        }

        $path = $request->file('document')->store('certifications', 'public');

        Certification::create([
            'freelancer_id' => Auth::id(),
            'type' => $validated['type'],
            'description' => $validated['description'],
            'document_path' => $path,
        ]);

        return redirect()->route('freelancer.certifications.index')
            ->with('success', 'Certification submitted for verification.');
    }

    public function destroy($id)
    {
        $cert = Certification::findOrFail($id);

        // Check ownership
        if ($cert->freelancer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the uploaded file from storage
        if ($cert->document_path && Storage::exists($cert->document_path)) {
            Storage::delete($cert->document_path);
        }

        // Delete the database record
        $cert->delete();

        return redirect()->back()->with('success', 'Certification deleted successfully!');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,expired',
        ]);

        $cert = Certification::findOrFail($id);
        $cert->status = $request->status;
        $cert->save();

        // Send email to the user
        // !Not sending an email for now
        // Mail::to($cert->freelancer->email)
        //     ->queue(new CertificationStatusChanged(
        //         $cert,
        //         $cert->status
        //     ));

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
