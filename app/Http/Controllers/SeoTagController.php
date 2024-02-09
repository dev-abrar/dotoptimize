<?php

namespace App\Http\Controllers;

use App\Models\AboutSeo;
use App\Models\BlogSeo;
use App\Models\HomeSeo;
use App\Models\ProductSeo;
use App\Models\ProjectSeo;
use App\Models\ServiceSeo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeoTagController extends Controller
{
    function home_seo(){
        $seo_info = HomeSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.home_seo', [
            'seos'=>$seos,
        ]);
    }

    function home_seo_store(Request $request){

        HomeSeo::find($request->seo_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'tag'=>$request->tag,
        ]);

        return back();
    }

    function about_seo(){
        $seo_info = AboutSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.about_seo', [
            'seos'=>$seos,
        ]);
    }

    function about_seo_store(Request $request){

        AboutSeo::find($request->seo_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'tag'=>$request->tag,
        ]);

        return back();
    }

    function service_seo(){
        $seo_info = ServiceSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.service_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function service_seo_store(Request $request){

         // AboutSeo::insert([
        //     'title'=>$request->title,
        //     'desp'=>$request->desp,
        //     'tag'=>$request->tag,
        //     'created_at'=>Carbon::now(),
        // ]);

        ServiceSeo::find($request->seo_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'tag'=>$request->tag,
        ]);

        return back();
    }

    function project_seo(){
        $seo_info = ProjectSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.proejct_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function project_seo_store(Request $request){


        ProjectSeo::find($request->seo_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'tag'=>$request->tag,
        ]);

        return back();
    }

    function product_seo(){
        $seo_info = ProductSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.product_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function product_seo_store(Request $request){

        ProductSeo::find($request->seo_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'tag'=>$request->tag,
        ]);

        return back();
    }

    
    function blog_seo(){
        $seo_info = BlogSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.blog_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function blog_seo_store(Request $request){

        BlogSeo::find($request->seo_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'tag'=>$request->tag,
        ]);

        return back();
    }


}
