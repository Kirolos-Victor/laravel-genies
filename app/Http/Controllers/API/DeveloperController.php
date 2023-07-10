<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use App\Repositories\DeveloperRepository;
use Illuminate\Http\JsonResponse;

class DeveloperController extends Controller
{
    public function __construct(protected DeveloperRepository $developerRepository)
    {
    }

    public function index(): JsonResponse
    {
        return response()
            ->json(DeveloperResource::collection($this->developerRepository->getAllDevelopers()));
    }

    public function store(StoreDeveloperRequest $request): JsonResponse
    {
        return response()
            ->json(DeveloperResource::make($this->developerRepository->createDeveloper($request->validated())));
    }

    public function update(UpdateDeveloperRequest $request, Developer $developer): JsonResponse
    {
        return response()
            ->json(DeveloperResource::make($this->developerRepository->updateDeveloper($developer, $request->validated())));
    }

    public function destroy(Developer $developer): JsonResponse
    {
        return response()
            ->json(DeveloperResource::make($this->developerRepository->deleteDeveloper($developer)));
    }
}
