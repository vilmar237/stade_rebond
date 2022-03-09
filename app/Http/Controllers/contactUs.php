<?php

namespace App\Http\Controllers;

use App\Mail\rebondMail;
use App\Mail\receive;
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
        Mail::to('djilovilmar@gmail.com')->send(new rebondMail($data));
        Mail::to($data['email'])->send(new receive($data));
        return back()->with('success','Merci de nous avoir contacté! nous reviendrons vers dans les bref delais');
    }
}
