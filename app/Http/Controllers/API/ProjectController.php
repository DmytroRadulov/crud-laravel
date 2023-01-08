<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController
{
    public function ListProject()
    {
        $projects = $this->getProjects();
        return view('project/index', compact('projects'));

    }

    public function author($id)
    {
        $projects = $this->getProjects(['user_id' => $id]);
        return $projects;

    }
    public function create()
    {
        $project = new Project();
        return view('project/form', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:name'
            ]
        ]);

        Project::create($request->all());
        return redirect()->route('project');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project');
    }

    private function getProjects($params = [])
    {
        $posts = Project::with(['user']);
        if (!empty($params)) {
            $posts->where($params);
        }
        return $posts->get();
    }
}
