<?php

namespace App\Http\Controllers\Barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardBarberoController extends Controller {

    public function index() {
        return view('barbero.dashboard.index');
    }
}
