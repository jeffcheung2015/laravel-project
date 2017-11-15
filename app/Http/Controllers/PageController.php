<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
class PageController extends Controller
{
 	public function getIndex(){
 		return view('index'); 		
 	}
 	public function getLogin(){ 		
 		return view('loginRegis');
 	}
 	public function getAccountSetting(){
 		if(!Session::has('username')){
 			return view('error');
 		}
 		return view('accountSetting');
 	}
 	public function getUpload(){
 		if(!Session::has('username')){
 			return view('error');
 		}
 		return view('upload');
 	}

 	public function getContact(){
 		return view('contact');
 	}

 	public function getPage(Request $request){
 		$cntOfRows = DB::table('images')->count();
 		$maxPages = ceil($cntOfRows/6);
 		if($request->path() !='/' &&
 		 intVal($request->path()) > $maxPages){
 			return view('error');
 		}
 		return view('index');
 	}

}
