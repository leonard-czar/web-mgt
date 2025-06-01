<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository
{
    public function paginated(int $perPage = 15)
    {
        return Project::with('employee.department')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Project::with('employee.department')->find($id);
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data)
    {
        return $project->update($data);
    }

    public function delete(Project $project)
    {
        return $project->delete();
    }
}