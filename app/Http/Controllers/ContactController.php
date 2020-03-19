<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\Contacts\StoreContactRequest;
use App\Http\Requests\Contacts\UpdateContactRequest;
use App\Imports\ContactsImport;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Auth::user()->contacts;
        $groups = Auth::user()->groups;

        return view('contacts.index', compact("contacts", "groups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Contacts\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->user()->associate(Auth::user());
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->save();

        return redirect()->route('contacts.index')->with('success', 'Contact added');
    }

    public function import(Request $request)
    {
        Excel::import(new ContactsImport, $request->file);

        return redirect()->back()->with('success', 'Contacts imported');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact("contact"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Contacts\UpdateContactRequest  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->save();

        return redirect()->route('contacts.index')->with('success', 'Contact updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contact $contact)
    {
        $this->authorize('delete', $contact);

        if ($contact->delete()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'The contact was deleted'
                ]);
            }

            return redirect()->back()->with('success', 'The contact was deleted');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'There was a problem deleting the contact'
            ]);
        }

        return redirect()->back()->with('error', 'There was a problem deleting the contact');
    }

    /**
     * Remove multiple specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyMultiple(Request $request)
    {
        $contacts = Contact::whereIn('id', $request->contacts)->get();

        $this->authorize('delete', $contacts);

        if (Contact::whereIn('id', $request->contacts)->delete()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'The contacts were deleted'
                ]);
            }

            return redirect()->back()->with('success', 'The contacts were deleted');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'There was a problem deleting the contacts'
            ]);
        }

        return redirect()->back()->with('error', 'There was a problem deleting the contacts');
    }
}
