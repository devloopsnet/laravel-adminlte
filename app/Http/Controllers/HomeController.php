<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 * @date 2019-07-16
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->to(route('admin.dashboard.index'));
    }
}
