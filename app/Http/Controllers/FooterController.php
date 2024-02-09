<?php

namespace App\Http\Controllers;

use App\Models\AddWorkWay;
use App\Models\Footer;
use App\Models\FooterIcon;
use App\Models\Policy;
use App\Models\Request_form;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class FooterController extends Controller
{

    function add_title(){
        $titles = Request_form::all();
        return view('admin.footer.request_title',[
            'titles'=>$titles ,
        ]);
    }
    function update_title(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
        ]);

       Request_form::where('id', $request->id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
            return back();
    }
    //footer Info
    function footer_info(){
        $footer_info = Footer::all();
        foreach($footer_info as $footer){
            $footers = $footer;
        }
        $icons = FooterIcon::all();
        return view('admin.footer.footer_info', [
            'footers'=>$footers,
            'icons'=>$icons,
        ]);
    }

    // footer Update
    function footer_update(Request $request){
        $request->validate([
            'footer_logo'=>'mimes:png,jpg',
        ]);

        if($request->footer_logo==''){
            Footer::find($request->footer_id)->update([
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'start_day'=>$request->start_day,
                'end_day'=>$request->end_day,
                'close_day'=>$request->close_day,
                'start_time'=>$request->start_time,
                'close_time'=>$request->close_time,
              ]);
        }
        else{
            $foot_img = $request->footer_logo;
            $extension = $foot_img->getClientOriginalExtension();
            $size = $foot_img->getSize();
            $file_name = $request->footer_id.'.'.$extension;
    
            
            if($size < 2000000){
                Image::make($foot_img)->save(public_path('upload/footer/'.$file_name));
                Footer::find($request->footer_id)->update([
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'start_day'=>$request->start_day,
                'end_day'=>$request->end_day,
                'close_day'=>$request->close_day,
                'start_time'=>$request->start_time,
                'close_time'=>$request->close_time,
                'footer_logo'=>$file_name,
              ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
        }

        
        return back()->withFooter('Footer Info Updated successfully!');

    }

    // footer icon
    function footer_icon_store(Request $request){
        $request->validate([
            'icon'=>'required',
        ]);

        FooterIcon::insert([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withIcon('Icon Added Successly!');
    }

    // Footer icon delete
    function footer_icon_delete($icon_id){
        FooterIcon::find($icon_id)->delete();
        return back();
    }

    // footer Icon edit
    function footer_icon_edit($icon_id){
        $icons = FooterIcon::find($icon_id);
        return view('admin.footer.footer_icon_edit', [
            'icons'=>$icons,
        ]);
    }

    // footer icon update
    function footer_icon_update(Request $request){
        FooterIcon::find($request->icon_id)->update([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
        ]);

        return back()->withIcon('Icon Updated Successly!');
    }

    // add work way
    function work_way(){
        $works = AddWorkWay::all();
        return view('admin.footer.add_work_way', [
            'works'=>$works,
        ]);
    }

    // add work way store
    function work_way_store(Request $request){
        $request->validate([
            'add_way'=>'required',
        ]);
        AddWorkWay::insert([
            'add_way'=>$request->add_way,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('work', 'Work way Added Successfully!');
    }

    // Work way delete
    function work_way_delete($work_id){
        AddWorkWay::find($work_id)->delete();
        return back();
    }

    // privacy policy
    function edit_policy(){
        $policies = Policy::all();
        foreach($policies as $policy){
            $policy_info = $policy;
        }
        return view('admin.footer.edit_policy', [
            'policy_info'=>$policy_info,
        ]);
    }

    // Update privacy policy
    function policy_update(Request $request){

        Policy::find($request->policy_id)->update([
            'desp'=>$request->desp,
        ]);
        return back()->with('policy', 'Privacy Policy Updated Successfully!');
    }

}
