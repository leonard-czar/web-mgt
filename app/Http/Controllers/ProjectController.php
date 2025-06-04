<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Services\ProjectService;


use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = $this->projectService->getPaginatedProjects();
        return view('projects.index', compact('projects'));
    }

    public function create(Employee $employee)
    {
        $employees = $employee->with('department')->get();
        return view('projects.create', compact('employees'));
    }

    public function store(ProjectRequest $request)
    {
        $this->projectService->createProject($request->validated());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }


    public function show(Project $project)
    {
        $project = $this->projectService->getProjectById($project->id);

        // Load comments with user relationships
        $project->load(['comments.user']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $employees = Employee::with('department')->get();
        return view('projects.edit', compact('project', 'employees'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectService->updateProject($project, $request->validated());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project);

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
