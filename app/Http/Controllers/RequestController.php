<?php

namespace App\Http\Controllers;

use App\Models\Request as SupportRequest; //para evitar errores tuve que agregar un alias 
use App\Models\Category;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $status = request('status');

        $requests = SupportRequest::with('category')
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('requests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:pending,in_progress,resolved',
        ]);

        SupportRequest::create($validated);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Solicitud creada correctamente.');
    }

    public function edit(SupportRequest $supportRequest)
    {
        $categories = Category::all();

        return view('requests.edit', compact('supportRequest', 'categories'));
    }

    public function update(Request $request, SupportRequest $supportRequest)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:pending,in_progress,resolved',
        ]);

        $supportRequest->update($validated);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy(SupportRequest $supportRequest)
    {
        $supportRequest->delete();

        return redirect()
            ->route('requests.index')
            ->with('success', 'Solicitud eliminada correctamente.');
    }
}