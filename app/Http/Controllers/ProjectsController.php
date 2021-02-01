<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_description' => 'required'
        ]);

        return response([
            'project' => 'Projects was created successfully!'
        ]);
    }
}
