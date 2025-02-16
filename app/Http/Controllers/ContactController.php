<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use SimpleXMLElement;

class ContactController extends Controller
{
    public function uploadXML(Request $request)
    {

       
        $request->validate([
            'xml_file' => 'required|file|max:2048'
        ]);
    
        if ($request->hasFile('xml_file')) {
            $file = $request->file('xml_file');
            $xmlContent = file_get_contents($file->getPathname());
            $xml = simplexml_load_string($xmlContent);

            $inserted = 0;
            $skipped = 0;
    
            foreach ($xml->contact as $contact) {


                 // ✅ Check if phone number already exists
                 if (!Contact::where('phone', $contact->phone)->exists()) {
                    
                    Contact::create([
                        'name' => (string) $contact->name,
                        'phone' => (string) $contact->phone
                    ]);

                    $inserted++;
                } else {
                    $skipped++;
                }


                
            }
    
            return back()
            ->with('success', "$inserted new contacts added.")
            ->with('skipped', $skipped);

        }
    
        return back()->withErrors(['xml_file' => 'Invalid XML file']);
    }



    public function showUploadForm()
    {
        $contacts = Contact::latest()->get();
        return view('upload', compact('contacts'));
    }
}
