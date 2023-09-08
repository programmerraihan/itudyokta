<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.frontend.contact.index', compact('contacts'));
    }


    public function store(Request $request)
    {
        // return $request->all();
        $contact = new Contact();
        $contact->name              =  $request->input('name');
        $contact->email              =  $request->input('email');
        $contact->phone              =  $request->input('phone');
        $contact->message              =  $request->input('message');
        $contact->status             =  $request->input('status');
        $contact->save();
        return redirect('/')->with('message', 'Our contact info create successfully');
    }

    


    public function destroy($id)
    {
        $this->center = Contact::find($id);
        // dd($this->project);
        $this->center->delete();
        return redirect('/contact-index')->with('message', 'Contact info Delete Successfully');
    }

    // public function storeHome(Request $request)
    // {
    //      return $request->all();
    //     // $contact = new Contact();
    //     // $contact->name              =  $request->input('name');
    //     // $contact->email              =  $request->input('email');
    //     // $contact->phone              =  $request->input('phone');
    //     // $contact->message              =  $request->input('message');
    //     // $contact->status             =  $request->input('status');
    //     // $contact->save();
    //     // return redirect('/')->with('message', 'Our contact info create successfully');
    // }
}
