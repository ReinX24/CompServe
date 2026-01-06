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
        // Validate all certifications
        $validated = $request->validate([
            'certifications' => 'required|array|min:1',
            'certifications.*.type' => 'required|string|max:255',
            'certifications.*.custom_certification' => 'nullable|string|max:255',
            'certifications.*.description' => 'nullable|string',
            'certifications.*.document' => 'required|file|mimes:pdf,jpg,png,jpeg|max:5120'
        ]);

        $createdCount = 0;

        // Loop through each certification and create
        foreach ($validated['certifications'] as $certData) {
            // Use custom certification name if "other" was selected
            $certType = $certData['type'];
            if ($certType === 'other' && !empty($certData['custom_certification'])) {
                $certType = $certData['custom_certification'];
            }

            // Store the document
            $path = $certData['document']->store('certifications', 'public');

            // Create certification
            Certification::create([
                'freelancer_id' => Auth::id(),
                'type' => $certType,
                'description' => $certData['description'] ?? null,
                'document_path' => $path,
            ]);

            $createdCount++;
        }

        return redirect()->route('freelancer.certifications.index')
            ->with('success', "{$createdCount} certification(s) submitted for verification.");
    }

    public function destroy($id)
    {
        $cert = Certification::findOrFail($id);

        if ($cert->freelancer_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($cert->document_path && Storage::disk('public')->exists($cert->document_path)) {
            Storage::disk('public')->delete($cert->document_path);
        }

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

        return back()->with('success', 'Certification status updated to ' . $request->status);
    }

    public function approve($id)
    {
        $cert = Certification::findOrFail($id);
        $cert->update(['status' => 'approved']);

        Mail::to($cert->freelancer->email)
            ->queue(new CertificationStatusChanged($cert, 'approved'));

        return back()->with('success', 'Certification approved.');
    }

    public function reject($id)
    {
        $cert = Certification::findOrFail($id);
        $cert->update(['status' => 'rejected']);

        Mail::to($cert->freelancer->email)
            ->queue(new CertificationStatusChanged($cert, 'rejected'));

        return back()->with('success', 'Certification rejected.');
    }
}