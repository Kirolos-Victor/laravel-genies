<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(protected ProjectRepository $projectRepository)
    {
    }

    public function index(): JsonResponse
    {
        return response()
            ->json(ProjectResource::collection($this->projectRepository->getAllProjects()));
    }

    public function show(Project $project): JsonResponse
    {
        return response()
            ->json(ProjectResource::make($project));
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        return response()
            ->json(ProjectResource::make($this->projectRepository->createProject($request->validated())));
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        return response()
            ->json(ProjectResource::make($this->projectRepository->updateProject($project, $request->validated())));
    }

    public function destroy(Project $project): JsonResponse
    {
        return response()
            ->json(ProjectResource::make($this->projectRepository->deleteProject($project)));
    }
}
