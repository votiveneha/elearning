<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use DB,Validator;
use Hash;
use Auth;

class AdminquesController extends Controller{

    public function __construct(){

    	$this->middleware('admin'); // Class admin does not exist

    }

	public function index(){
		return view("admin.add_questions");
	}
}	