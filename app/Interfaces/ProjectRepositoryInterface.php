<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface
{
    public function getAllProjects();

    public function createProject(array $projectDetails);

    public function updateProject($project, array $newDetails);

    public function deleteProject($project);
}
