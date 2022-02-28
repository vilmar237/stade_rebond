<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth as Login;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\TypeTerrain;
use App\Enums\UserRoles;
use App\Models\Hour;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;

class PublicController extends Controller
{
    public function __construct()
    {
 
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        $logged     = Login::check();
        $admins     = ($logged && in_array(Login::user()->role, [UserRoles::ADMIN, UserRoles::SUPER_ADMIN]));
        $hours = Hour::pluck('heure', 'id');
        $selectedID = 1;

        $already_exists_reservations = Reservation::get();

        $type_terrain = TypeTerrain::pluck('name', 'id');


        
        return view('frontend.index', compact('already_exists_reservations','hours','selectedID','type_terrain'));
    }

    public function userlogin(Request $request)
    {

        $dat = Session::get('data');
        //dd(Session::get('data'));
        if($dat == 1)
        {
            Toastr::error('Veuillez vous connecter au préalable','Erreur');
        }
        return view('auth.userlogin');
    }

    public function user_login(Request $request)
    {
        if (Login::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Login::user();

            if ($user->role == "C") {
                $user->status = 1;
                $user->save();
                return redirect('/');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                Toastr::error('Identifiants de connexion invalides ou client non vérifié','Reservation');
                return back();
            }
        }else {
            Toastr::error('Authentification invalide','Reservation');
            return back();
        }
    }

    public function user_logout(Request $request)
    {
        $user = Login::user();
        $user->status = 0;
        $user->save();
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function customer_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'register')->withInput();
        }

        $id = User::create([
            "username" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => "C",
            "status" => 0,
        ])->id;

        $user = User::find($id);
        $user->username = $request->name;
        $user->save();

        Toastr::success('Vous êtes inscrit avec succès ! veuillez vous connecter ici','Reservation');
        return back();

    }

    public function booking_history($id)
    {
        if (Auth::user()->id == $id) {
            $data['bookings'] = Reservation::where('id_user', $id)->latest()->get();
        } else {
            $data['bookings'] = [];
        }
        return view('frontend.historique_reservations', $data);
    }

    public function book(Request $request)
    {
        
        if (Auth::user() && Auth::user()->role == 'C') {
            $validation = Validator::make($request->all(), [
                'day' => 'required',
                'debut' => 'required',
                'fin' => 'required',
                'type_stade' => 'required',
            ]);

            if ($validation->fails()) {
                return back()->withErrors($validation)->withInput();
            } else {
                $hour_now = Carbon::now()->format('H:i');

                $todayDate = Carbon::now()->format('d-m-Y');
                //dd($todayDate);

                //dd($hour_now);
                //if($request->debut > $hour_now && $request->fin > $request->debut && $request->day != $todayDate)//<=
                //{

                   if($request->fin < $request->debut){
                    Toastr::error('L heure de fin doit etre superieur à l heure de debut','Erreur');
                    return back();
                   }
                    if($request->debut != $request->fin)
                    {
                        //$check_available_booking = Reservation::where('day',$request->day)->where('debut',$request->debut)->where('fin',$request->fin)->first();
                        $check_available_booking1 = Reservation::where('day',$request->day)->get();
                        foreach($check_available_booking1 as $reserv)
                        {
                            //echo $reserv->day;
                            
                            if($request->debut == $reserv->debut && $request->fin <= $reserv->fin || $request->debut >= $reserv->debut && $request->fin <= $reserv->fin)
                            {
                                Toastr::error('Intervalle horaire non disponible','Erreur');
                                return back();
                            }
                            else if($request->debut == $reserv->debut && $request->fin >= $reserv->fin || $request->debut >= $reserv->debut && $request->debut < $reserv->fin ){
                                Toastr::error('Vous pouvez uniquement faire des reservations à partir d\'une heure supérieure à '.$reserv->fin.' pour la date choisie','Erreur');
                                return back();
                            }
                        }

                        //if($check_available_booking == null)
                        //{
                            $timeDifference = Carbon::parse($request->fin)->diffInMinutes(Carbon::parse($request->debut));
                            $sd = $timeDifference / 60; // decimal hours
                            $whole = intval($sd);
                            $nouveauPrix = 10000*$whole;
                            $id = Reservation::create(['id_user' => Auth::user()->id,
                                'day' => $request->day,
                                'debut' => $request->debut,
                                'fin' => $request->fin,
                                'id_type_terrain' => $request->type_stade,
                                'prix' => $nouveauPrix,
                            ])->id;

                            $booking = Reservation::find($id);
                            //$booking->id_type_terrain = $request->type_stade;
                            $booking->save();
                        
                        //}
                        Toastr::success('Reservation effectuée avec succès','Reservation');
                        return back();
                    }
                    else{
                        Toastr::error('L\'heure de début est égale à l\'heure de fin. Veuillez modifier','Erreur');
                        return back();
                    }
                //}
                //else{
                //    Toastr::error('Horaires non conformes. Veuillez réessayer','Erreur');
                //    return back();
                //}
            }
            //notify()->success( 'Reservation effectuée avec succès');
            //return back();
        } else {
            $data = 1;
            Toastr::error('Veuillez vous connecter au préalable','Erreur');
            return redirect("user-login")->with( ['data' => $data] );
        }

    }

    
}
