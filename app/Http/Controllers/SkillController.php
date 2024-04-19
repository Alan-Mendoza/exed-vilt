<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        return Inertia::render('Skills/index', [
            'skills' => Skill::all(),
            'colors' => Skill::getAvailableBackgroundColors(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:225', Rule::unique(Skill::class)],
            'color' => ['required', 'in:' . implode(',', Skill::getAvailableBackgroundColors())],
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index');
    }
}
