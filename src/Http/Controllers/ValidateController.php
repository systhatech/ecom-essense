<?php

namespace Systha\EssencesSite\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function validateGeneral(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ], [
            'required' => 'This field is required',
            'email' => 'Must be a valid email',
            'min' => 'Must be at least 6 characters',
            'confirmed' => 'Confirmation does not match'
        ]);
    }
    public function validatePayment(Request $request)
    {
        $request->validate([
            'card_no' => 'required',
            'cvv' => 'required',
            'expy' => 'required',
            'expm' => 'required'
        ], [
            'required' => 'Required'
        ]);
    }
    public function validateOrderPersonal(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required',
            'fname' => 'required',
            'phone_no'=> 'required | min: 10'
        ], [
            'required' => 'This field is required!',
            'min' => 'must be atleast 10 digit'
        ]);
    }
    public function validateOrderContact(Request $request)
    {
        $request->validate([
            'add1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            
        ], [
            'required' => 'This field is required!',
            'min' => 'must be atleast 10 digit'
        ]);
    }
}
