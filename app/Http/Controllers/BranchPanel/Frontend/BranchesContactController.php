<?php

namespace App\Http\Controllers\BranchPanel\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchesContactController extends Controller
{
    public function index()
    {
        $id = Auth::guard('branch')->user()->id;
        $contacts =  Contact::where('branch_id', $id)->get();
        
        // $contacts = Contact::all();
        return view('branch.branch-panel.home.contact.index', compact('contacts'));
    }

    public function addContact(){
        return view('branch.branch-panel.home.contact.add');
    }


    public function store(Request $request)
    {
        // return $request->all();
        $contact = new Contact();
        $contact->branch_id         = Auth::guard('branch')->user()->id;
        $contact->name              = $request->input('name');
        $contact->email             = $request->input('email');
        $contact->phone             = $request->input('phone');
        $contact->message           = $request->input('message');
        $contact->status            = $request->input('status');
        $contact->save();
        return redirect('branches/contact-index')->with('message', 'Our contact info create successfully');
    }

    
    public function updateStatus($id)
    {
        return  redirect()->back()->with('message', Contact::updateContactStatus($id));
    }

    


    public function destroy($id)
    {
        $this->center = Contact::find($id);
        // dd($this->project);
        $this->center->delete();
        return redirect('branches/contact-index')->with('message', 'Contact info Delete Successfully');
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
