<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;

class ContactMessageController extends Controller
{
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
