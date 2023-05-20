<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class CustomerController extends Controller
{
    function customer_reg_log(){
        return view('frontend.customer.register_login');
    }
    function customer_register_store(Request $request){
        Customerlogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('/');
        }

    }

    function customer_login(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('/');
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
        return view('frontend.customer.profile');
    }
    function customer_profile_update(Request $request){

        //if photo not exist
        if($request->photo == ''){
            if($request->password == ''){
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                ]);
                return back();
            }
            else{
                if(Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)){
                    Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'address'=>$request->address,
                        'password'=>Hash::make($request->password),
                    ]);
                    return back();
                }
                else{
                    return back()->with('old', 'Current Password Wrong');
                }
            }
        }

        //if photo exist
        else{
            if($request->password == ''){
                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id().'.'.$extension;

                Image::make($photo)->save(public_path('uploads/customer/'.$file_name));
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                    'photo'=>$file_name,
                ]);
                return back();
            }
            else{
                if(Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)){
                    $photo = $request->photo;
                    $extension = $photo->getClientOriginalExtension();
                    $file_name = Auth::guard('customerlogin')->id().'.'.$extension;

                    Image::make($photo)->save(public_path('uploads/customer/'.$file_name));
                    Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'country'=>$request->country,
                        'address'=>$request->address,
                        'password'=>Hash::make($request->password),
                        'photo'=>$file_name,
                    ]);
                    return back();
                }
                else{
                    return back()->with('old', 'Current Password Wrong');
                }
            }
        }
    }
}
