<?php

namespace App\Repositories;

use App\Interfaces\DeveloperRepositoryInterface;
use App\Models\Developer;
use Illuminate\Support\Collection;

class DeveloperRepository implements DeveloperRepositoryInterface
{
    public function getAllDevelopers(): Collection
    {
        return Developer::all();
    }

    public function createDeveloper(array $developerDetails)
    {
        return Developer::create($developerDetails);
    }

    public function updateDeveloper($developer, array $newDetails)
    {
        if ($newDetails['password'] == null) {
            unset($newDetails['password']);
            unset($newDetails['password_confirmation']);
        }
        $developer->update($newDetails);

        return $developer;
    }

    public function deleteDeveloper($developer)
    {
        $developer->delete();

        return $developer;
    }
}
