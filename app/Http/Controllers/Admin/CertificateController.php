<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $path = $request->file('image')->store('certificates', 'public');

        Certificate::create([
            'title' => $validated['title'],
            'image' => $path,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Sertifikat berhasil diupload.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        Storage::disk('public')->delete($certificate->image);
        $certificate->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Sertifikat berhasil dihapus.');
    }
}
