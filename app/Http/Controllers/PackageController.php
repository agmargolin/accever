<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PackageController extends Controller
{
    private $package;

    function __construct() { //todo __construct method for all Controller classes 
        $package = new Package();
    }
    
}
