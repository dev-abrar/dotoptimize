<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stripe\Customer as StripeCustomer;
use Image;

class CustomerController extends Controller
{
    function customer_login(){
        return view('frontned.login');
    }
    function customer_register(){
        return view('frontned.register');
    }


    function register_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:customers',
            'phone'=>'required|min:16|numeric',
            'password'=>'required',
        ]);

        customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
        ]);

        if(Auth::guard('customerlogin')->attempt(['email'=> $request->email, 'password'=> $request->password])){
            return redirect()->route('index');
          }
    }

    function customer_login_info(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        
        if(Auth::guard('customerlogin')->attempt(['email'=> $request->email, 'password'=> $request->password])){
          return redirect()->route('index');
        }
        else{
            return back()->with('wrong', 'Wrong Credential');
        }
    }

    function customer_logout(){
        Auth::guard('customerlogin')->logout();

        return redirect('/');
    }

    function customer_profile(){

        return view('frontned.customer_profile');
    }

    function customer_profile_update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);

        if($request->photo == ''){
            if($request->password == ''){
                customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                ]);
                return back();
            }
            else{
                customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                ]);
            }

            return back();

        }

        else{
            if($request->password == ''){
                
                if(customer::find(Auth::guard('customerlogin')->user()->photo != '')){
                    $delete_from = public_path('upload/customer/'.Auth::guard('customerlogin')->user()->photo);
                    unlink($delete_from);
                }

                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id().'.'.$extension;
                Image::make($photo)->save(public_path('upload/customer/'.$file_name));

                customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'photo'=>$file_name,
                ]);
                return back();
            }

            else{

                if(customer::find(Auth::guard('customerlogin')->user()->photo != '')){
                    $delete_from = public_path('upload/customer/'.Auth::guard('customerlogin')->user()->photo);
                    unlink($delete_from);
                }

                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id().'.'.$extension;
                Image::make($photo)->save(public_path('upload/customer/'.$file_name));

                customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'photo'=>$file_name,
                ]);
                return back();
            }
        }
    }

    function order_history(){
       $orders = Order::where('customer_id', Auth::guard('customerlogin')->id())->orderBy('created_at', 'DESC')->get();
        return view('frontned.order_history',[
           'orders'=>$orders,
        ]);
    }

}