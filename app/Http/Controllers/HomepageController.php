<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomepageController extends Controller
{
    /**
     * Render the homepage.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Homepage');
    }
}
