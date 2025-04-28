<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan semua pesan kontak.
     */
    public function manage()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.manage', compact('contacts'));
    }

    /**
 * Menampilkan detail pesan kontak.
 */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Jika pesan belum dibaca, ubah status jadi "read"
        if ($contact->status == 0) {
            $contact->update(['status' => 1]);
        }

        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Menghapus pesan kontak.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact message deleted successfully.');
    }
}
