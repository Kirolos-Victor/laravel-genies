<?php

namespace App\Interfaces;

interface DeveloperRepositoryInterface
{
    public function getAllDevelopers();

    public function createDeveloper(array $developerDetails);

    public function updateDeveloper($developer, array $newDetails);

    public function deleteDeveloper($developer);
}
