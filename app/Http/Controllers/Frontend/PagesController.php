<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function Dashboard(Request $request)
    {
        return Inertia::render("Dashboard");
    }

    public function CreateInvoice(Request $request)
    {
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/Invoice/Create");
    }

    public function Clients(Request $request)
    {
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/Clients/Index");
    }

    public function Invoices(Request $request)
    {
        Inertia::setRootView("layouts.frontend.index");
        return Inertia::render("Frontend/Invoice/List");
    }
}
