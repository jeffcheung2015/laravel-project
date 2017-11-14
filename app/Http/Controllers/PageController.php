<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
 	public function getIndex(){
 		return view('index');
 		
 	}
 	public function getLogin(){
 		return view('loginRegis');
 	}
 	public function getAccountSetting(){
 		return view('accountSetting');
 	}
 	public function getUpload(){
 		return view('upload');
 	}

 	public function getContact(){
 		return view('contact');
 	}

 	public function getPage(){
 		return view('index');
 	}

}
