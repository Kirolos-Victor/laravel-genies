<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Support\Collection;
use Mockery\Undefined;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function getAllProjects(): Collection
    {
        return Project::with('developers')->get();
    }

    public function createProject(array $projectDetails)
    {
        $project = Project::create($projectDetails);
        $project->developers()->attach($projectDetails['developers']);
        return $project;
    }

    public function updateProject($project, array $newDetails)
    {
        $project->update($newDetails);
        if ($newDetails['developers']) {
            $project->developers()->detach();
            $project->developers()->attach($newDetails['developers']);
        }

        return $project;
    }

    public function deleteProject($project)
    {
        $project->developers()->detach();
        $project->delete();

        return $project;
    }
}
