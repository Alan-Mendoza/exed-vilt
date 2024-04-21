<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/index', [
            'projects' => Project::all(),
            'colors' => Project::getAvailableTextColors(),
            'icons' => Project::getAvailableIcons(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:225', Rule::unique(Project::class)],
            'description' => ['required', 'string', 'max:225'],
            'color' => ['required', 'in:' . implode(',', Project::getAvailableTextColors())],
            'icon_name' => ['required', 'in:' . implode(',', Project::getAvailableIcons())],
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index');
    }
}
