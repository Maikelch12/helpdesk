<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function index(HttpRequest $request)
    {
        $query = Request::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->get();

        $categories = Category::all();

        return view('requests.index', compact('requests', 'categories'));
    }
}