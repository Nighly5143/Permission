<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\UserLog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // public function logs(){
    //     $logs = auth()->user()->logs;
    //     return view('log');
    // }
}
