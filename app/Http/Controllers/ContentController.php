<?php

namespace App\Http\Controllers;

use App\Car;
use App\Content;
use App\Helper\Reply;
use App\Notifications\NewUser;
use App\Product;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function addmycar(){
        $pageTitle = 'Ajouter une voiture';
        return view('admin.mycar.add', compact('pageTitle'));
    }
    public function carstore(Request $request){
        $car = new Car();
        $car->user_id = Auth::user()->id;
        $car->name = $request->name;
        $car->type = $request->type;
        $car->make = $request->make;
        $car->license = $request->license;
        $car->save();
        return redirect()->route('mycar.index');
    }
    public function index(){
        $pageTitle = 'Voiture';
        $cars = Car::where('user_id', Auth::user()->id)->get();
        return view('admin.mycar.index', compact('cars', 'pageTitle'));
    }
    public function singleProduct($id){
        $pageTitle = 'Product';
        $product = Product::find($id);
        return view('front.singleProduct', compact('product', 'pageTitle'));
    }
    public function contentStore(Request $request){
        $content = Content::find(1);
        $content->h1 = $request->h1;
        $content->h2 = $request->h2;
        $content->h3 = $request->h3;
        $content->h4 = $request->h4;
        $content->h5 = $request->h5;
        $content->h6 = $request->h6;
        $content->h7 = $request->h7;
        $content->h8 = $request->h8;
        $content->h9 = $request->h9;
        $content->h10 = $request->h10;
        $content->h11 = $request->h11;
        $content->h12 = $request->h12;
        $content->h13 = $request->h13;
        $content->h14 = $request->h14;
        $content->h15 = $request->h15;
        $content->h16 = $request->h16;
        $content->h17 = $request->h17;
        $content->h18 = $request->h18;
        $content->h19 = $request->h19;
        $content->h20 = $request->h20;
        $content->h21 = $request->h21;
        $content->h22 = $request->h22;
        $content->h23 = $request->h23;
        $content->h24 = $request->h24;
        $content->h25 = $request->h25;
        $content->h26 = $request->h26;
        $content->h27 = $request->h27;
        $content->h28 = $request->h28;
        $content->h29 = $request->h29;
        $content->update();
        return redirect()->back();
    }
    public function customerSave(Request $request){
        $user = new User();
        $user->name = $request->name;
            $user->email = $request->email;
        $user->calling_code = $request->calling_code;
        $user->mobile = $request->mobile;
        $user->password = $request->password;
        $user->save();
        // add customer role
        $user->attachRole(Role::where('name', 'customer')->withoutGlobalScopes()->first()->id);


       return redirect()->route('admin.customers.index');
    }
    public function register(Request $request){
//        $validator=$request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  $request->password;
        $user->save();
       $user->attachRole(Role::where('name', 'customer')->withoutGlobalScopes()->first()->id);
        Auth::login($user);
               return redirect()->route('admin.dashboard');

    }
}
