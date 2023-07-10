<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects(): Collection
    {
        return Project::all();
    }

    public function createProject(array $projectDetails)
    {
        return Project::create($projectDetails);
    }

    public function updateProject($project, array $newDetails)
    {
        $project->update($newDetails);

        return $project;
    }

    public function deleteProject($project)
    {
        $project->delete();

        return $project;
    }
}
