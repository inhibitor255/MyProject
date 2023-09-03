<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // direct admin contact list page
    public function listPage()
    {
        $contacts = Contact::get();
        return view('admin.contact.list', compact('contacts'));
    }

    // direct user contact page
    public function page()
    {
        return view('user.contact.page');
    }

    // delete contact from admin
    public function delete($id)
    {
        Contact::where('id', $id)->delete();
        return back();
    }

    // create user contact
    public function submitForm(Request $request)
    {
        $this->contactValidationCheck($request);
        $data = $this->requestContactData($request);
        Contact::create($data);
        return redirect()->route('user#homePage');
    }

    private function contactValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required|min:4|unique:categories,name, ' . request()->id,
                'email' => 'required|email',
                'message' => 'required|min:30',
            ],
        )->validate();
    }

    private function requestContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}
