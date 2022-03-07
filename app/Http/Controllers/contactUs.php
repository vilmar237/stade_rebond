<?php

namespace App\Http\Controllers;

use App\Mail\rebondMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactUs extends Controller
{


    public function contact(Request $request){

        $this->validate($request, [
            'name' =>'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
            
        ];
        Mail::to($data['email'])->send(new rebondMail($data));
        return back()->with('success','Merci de nous avoir contacté! nous reviendrons vers dans les bref delais');
    }
}
