<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectService
{
    protected ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getPaginatedProjects(int $perPage = 5): LengthAwarePaginator
    {
        return $this->projectRepository->paginated($perPage);
    }

    public function getProjectById(int $id)
    {
        return $this->projectRepository->findById($id);
    }

    public function createProject(array $data)
    {
        return $this->projectRepository->create($data);
    }

    public function updateProject(Project $project, array $data): bool
    {
        return $this->projectRepository->update($project, $data);
    }

    public function deleteProject(Project $project): bool
    {
        return $this->projectRepository->delete($project);
    }
}
