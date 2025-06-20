<?php

namespace App\Helpers;

use App\Models\About;
use App\Models\Certifications;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Projects;
use App\Models\Skills;

class DataAggregator
{
    public static function getAllData(): array
    {
        try {
            $aboutModel    = new About();
            $certificationsModel = new Certifications();
            $contactModel  = new Contact();
            $educationModel = new Education();
            $experienceModel = new Experience();
            $projectsModel = new Projects();
            $skillsModel = new Skills();

            return [
                'status' => 'success',
                'data' => [
                    'about'          => $aboutModel->findAll(),
                    'certifications' => $certificationsModel->findAll(),
                    'contact'        => $contactModel->findAll(),
                    'education'      => $educationModel->findAll(),
                    'experience'     => $experienceModel->findAll(),
                    'projects'       => $projectsModel->findAll(),
                    'skills'         => $skillsModel->findAll(),
                ]
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'error',
                'message' => 'Failed to fetch data',
                'error' => $e->getMessage()
            ];
        }
    }
}
