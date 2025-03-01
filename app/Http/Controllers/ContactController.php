<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new contact
     */
    public function create()
    {
        return Inertia::render('Contacts/AddContact');
    }

    /**
     * Store the new contact
     */
    public function store(AddContactRequest $request)
    {
        if($request->validated()) {
            //save the contact
            Contact::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'phone' =>$request->phone,
                'job_title' =>$request->job_title,
                'company' =>$request->company,
                'country' =>$request->country,
                'country_code' =>$request->country_code,
                'user_id' => auth()->user()->id
            ]);

            //show the success message
            return redirect()->route('home')->with([
                'message' => 'Contact added successfully',
                'class' => 'alert alert-success'
            ]);
        }
    }

    /**
     * Show the form for editing a contact
     */
    public function edit(Contact $contact)
    {
        return Inertia::render('Contacts/EditContact')->with([
            'contact' => $contact
        ]);
    }

    /**
     * Update the contact
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        if($request->validated()) {
            //update the contact
            $contact->update([
                'name' =>$request->name,
                'email' =>$request->email,
                'phone' =>$request->phone,
                'job_title' =>$request->job_title,
                'company' =>$request->company,
                'country' =>$request->country,
                'country_code' =>$request->country_code,
                'user_id' => auth()->user()->id
            ]);

            //show the success message
            return redirect()->route('home')->with([
                'message' => 'Contact updated successfully',
                'class' => 'alert alert-success'
            ]);
        }
    }

    /**
     * Delete the contact
     */
    public function delete(Contact $contact)
    {
        if(auth()->user()->contacts->contains($contact)) {
            //delete the contact
            $contact->delete();
            //show the success message
            return redirect()->route('home')->with([
                'message' => 'Contact deleted successfully',
                'class' => 'alert alert-success'
            ]);
        }else {
            return redirect()->route('home')->with([
                'message' => 'Something went wrong try again later!',
                'class' => 'alert alert-danger'
            ]);
        }
    }

    /**
     * Order contacts by name
     */
    public function getContactsOrderedByName($direction)
    {
        return Inertia::render('Home/Index', [
            'contacts' => auth()->user()->contacts()->orderBy('name',$direction)->paginate(10),
            'selectedDirection' => $direction
        ]);
    }

    /**
     * Add a contact to favorites
     */
    public function addToFavorites(Contact $contact)
    {
        if(auth()->user()->contacts->contains($contact)) {
            //check if the contact is already in the favorites list
            //of the logged in user
            if(auth()->user()->favoriteContacts->contains($contact)) {
                auth()->user()->favoriteContacts()->detach($contact);
                //show the success message
                return redirect()->route('home')->with([
                    'message' => 'Contact removed from your favorites',
                    'class' => 'alert alert-success'
                ]);
            }else {
                auth()->user()->favoriteContacts()->attach($contact);
                //show the success message
                return redirect()->route('home')->with([
                    'message' => 'Contact added to your favorites',
                    'class' => 'alert alert-success'
                ]);
            }
        }else {
            return redirect()->route('home')->with([
                'message' => 'Something went wrong try again later!',
                'class' => 'alert alert-danger'
            ]);
        }
    }

    /**
     * Get user favorites list
     */
    public function favoriteContacts()
    {
        return Inertia::render('Home/Index', [
            'contacts' => auth()->user()->favoriteContacts()->paginate(10)
        ]);
    }

    /**
     * Search for contacts by name
     */
    public function findContactsByName(Request $request)
    {
        $contacts = Contact::where(
            'name','LIKE','%'.$request->query('searchTerm').'%'
        )->where('user_id',auth()->user()->id)
            ->paginate(10);

        return Inertia::render('Home/Index', [
            'contacts' => $contacts
        ]);
    }
}
