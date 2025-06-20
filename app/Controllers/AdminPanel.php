<?php

namespace App\Controllers;

use App\Models\About;

class AdminPanel extends BaseController
{
    /**
     * Display the admin panel home page.
     */
    public function index()
    {
        return view('cms_home');
    }

    /**
     * Return the About Me data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getAboutMe()
    {
        $about = new About;
        $data = $about->first(); // Assuming the about data is stored with ID 1
        return $this->response->setJSON($data);
    }

    /**
     * Update the About Me section.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function updateAboutMe()
    {
        $about = new About;
        $data = [
            'id' => 1, // Assuming the about data is stored with ID 1
            'aboutText' => htmlspecialchars($this->request->getPost('aboutText')),
        ];

        // Update or insert the about data
        if ($about->replace($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'About Me updated successfully']);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($about->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update About Me']);
        }
    }

    /**
     * Return the Skills data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getSkills()
    {
        $skillsModel = new \App\Models\Skills();
        $skills = $skillsModel->findAll();
        return $this->response->setJSON(['skills' => $skills]);
    }

    /**
     * Add/Update a skill.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function addSkill()
    {
        $skillsModel = new \App\Models\Skills();
        $skillName = htmlspecialchars($this->request->getPost('skillName'));
        $skillId = htmlspecialchars($this->request->getPost('skillId'));

        // Validate the skill name
        if (empty($skillName)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Skill name cannot be empty']);
        }
        if (strlen($skillName) > 255) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Skill name is too long']);
        }

        $message = $skillId ? 'Skill updated successfully' : 'Skill added successfully';

        if ($skillsModel->save(['skillName' => $skillName, 'id' => $skillId])) {
            return $this->response->setJSON(['status' => 'success', 'message' => $message]);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($skillsModel->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add skill']);
        }
    }

    /**
     * Delete the Skills.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function deleteSkill()
    {
        $skillsModel = new \App\Models\Skills();
        $skillId = htmlspecialchars($this->request->getPost('skillId'));

        // Validate the skill ID
        if (empty($skillId) || !is_numeric($skillId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid skill ID']);
        }

        if ($skillsModel->delete($skillId)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Skill deleted successfully']);
        } else {
            log_message('error', 'Failed to delete skill with ID: ' . $skillId);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete skill']);
        }
    }

    /**
     * Return the Experience data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getExperience()
    {
        $experienceModel = new \App\Models\Experience();
        $experience = $experienceModel->findAll();
        return $this->response->setJSON(['experience' => $experience]);
    }

    /**
     * Add a new experience entry.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function addExperience()
    {
        $experienceModel = new \App\Models\Experience();
        $data = [
            'id' => htmlspecialchars($this->request->getPost('id')) ?: null, // Allow null for new entries
            'expJobTitle' => htmlspecialchars($this->request->getPost('expJobTitle')),
            'expCompany' => htmlspecialchars($this->request->getPost('expCompany')),
            'expLocation' => htmlspecialchars($this->request->getPost('expLocation')),
            'expStartDate' => htmlspecialchars($this->request->getPost('expStartDate')),
            'expEndDate' => htmlspecialchars($this->request->getPost('expEndDate')) ?: null, // Allow null for end date
            'expDescription' => htmlspecialchars($this->request->getPost('expDescription')),
        ];

        // Validate required fields
        foreach ($data as $key => $value) {
            if (empty($value) && ($key !== 'expEndDate' && $key !== 'id')) {
                return $this->response->setJSON(['status' => 'error', 'message' => ucfirst($key) . ' cannot be empty']);
            }
        }

        $message = is_null($data['id']) ? 'Experience added successfully' : 'Experience updated successfully';

        if ($experienceModel->save($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => $message]);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($experienceModel->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add experience']);
        }
    }

    /**
     * Delete Experience.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function deleteExperience()
    {
        $experienceModel = new \App\Models\Experience();
        $expId = htmlspecialchars($this->request->getPost('expId'));

        // Validate the experience ID
        if (empty($expId) || !is_numeric($expId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid experience ID']);
        }

        if ($experienceModel->delete($expId)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Experience deleted successfully']);
        } else {
            log_message('error', 'Failed to delete experience with ID: ' . $expId);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete experience']);
        }
    }

    /**
     * Return the Projects data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getProjects()
    {
        $projectsModel = new \App\Models\Projects();
        $projects = $projectsModel->findAll();
        return $this->response->setJSON(['projects' => $projects]);
    }

    /**
     * Add a new or update project.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function addProject()
    {
        $projectsModel = new \App\Models\Projects();
        $data = [
            'id' => htmlspecialchars($this->request->getPost('id')) ?: null, // Allow null for new entries
            'projectTitle' => htmlspecialchars($this->request->getPost('projectTitle')),
            'projectDescription' => htmlspecialchars($this->request->getPost('projectDescription')),
            'repo_url' => htmlspecialchars($this->request->getPost('repo_url')),
            'demo_url' => htmlspecialchars($this->request->getPost('demo_url')),
        ];

        // Validate required fields
        foreach ($data as $key => $value) {
            if (empty($value) && ($key !== 'id' && $key !== 'demo_url' && $key !== 'repo_url')) {
                return $this->response->setJSON(['status' => 'error', 'message' => ucfirst($key) . ' cannot be empty']);
            }
        }

        $message = is_null($data['id']) ? 'Project added successfully' : 'Project updated successfully';

        if ($projectsModel->save($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => $message]);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($projectsModel->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add project']);
        }
    }

    /**
     * Delete a project.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function deleteProject()
    {
        $projectsModel = new \App\Models\Projects();
        $projectId = htmlspecialchars($this->request->getPost('projectId'));

        // Validate the project ID
        if (empty($projectId) || !is_numeric($projectId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid project ID']);
        }

        if ($projectsModel->delete($projectId)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Project deleted successfully']);
        } else {
            log_message('error', 'Failed to delete project with ID: ' . $projectId);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete project']);
        }
    }

    /**
     * Return the Education data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getEducation()
    {
        $educationModel = new \App\Models\Education();
        $education = $educationModel->findAll();
        return $this->response->setJSON(['education' => $education]);
    }

    /**
     * Add a new update education entry.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function addEducation()
    {
        $educationModel = new \App\Models\Education();
        $data = [
            'id' => htmlspecialchars($this->request->getPost('id')) ?: null, // Allow null for new entries
            'eduDegree' => htmlspecialchars($this->request->getPost('eduDegree')),
            'eduStartDate' => htmlspecialchars($this->request->getPost('eduStartDate')),
            'eduEndDate' => htmlspecialchars($this->request->getPost('eduEndDate')) ?: null, // Allow null for end date
            'eduSchool' => htmlspecialchars($this->request->getPost('eduSchool')),
        ];

        // Validate required fields
        foreach ($data as $key => $value) {
            if (empty($value) && ($key !== 'eduEndDate' && $key !== 'id')) {
                return $this->response->setJSON(['status' => 'error', 'message' => ucfirst($key) . ' cannot be empty']);
            }
        }

        $message = is_null($data['id']) ? 'Education added successfully' : 'Education updated successfully';

        if ($educationModel->save($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => $message]);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($educationModel->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add education']);
        }
    }

    /**
     * Delete Education.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function deleteEducation()
    {
        $educationModel = new \App\Models\Education();
        $eduId = htmlspecialchars($this->request->getPost('eduId'));

        // Validate the education ID
        if (empty($eduId) || !is_numeric($eduId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid education ID']);
        }

        if ($educationModel->delete($eduId)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Education deleted successfully']);
        } else {
            log_message('error', 'Failed to delete education with ID: ' . $eduId);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete education']);
        }
    }

    /**
     * Return the Certifications data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getCertifications()
    {
        $certificationsModel = new \App\Models\Certifications();
        $certifications = $certificationsModel->findAll();
        return $this->response->setJSON(['certifications' => $certifications]);
    }

    /**
     * Add a new certification.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function addCertification()  
    {
        $certificationsModel = new \App\Models\Certifications();
        $data = [
            'id' => htmlspecialchars($this->request->getPost('id')) ?: null, // Allow null for new entries
            'certTitle' => htmlspecialchars($this->request->getPost('certTitle')),
            'certDate' => htmlspecialchars($this->request->getPost('certDate')),
        ];

        // Validate required fields
        foreach ($data as $key => $value) {
            if (empty($value) && $key !== 'id') {
                return $this->response->setJSON(['status' => 'error', 'message' => ucfirst($key) . ' cannot be empty']);
            }
        }

        $message = is_null($data['id']) ? 'Certification added successfully' : 'Certification updated successfully';

        if ($certificationsModel->save($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => $message]);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($certificationsModel->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add certification']);
        }
    }

    /**
     * Delete a certification.
     *
     * @return \CodeIgniter\HTTP\Response
     */public function deleteCertification()    
     {
        $certificationsModel = new \App\Models\Certifications();
        $certId = htmlspecialchars($this->request->getPost('certId'));

        // Validate the certification ID
        if (empty($certId) || !is_numeric($certId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid certification ID']);
        }

        if ($certificationsModel->delete($certId)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Certification deleted successfully']);
        } else {
            log_message('error', 'Failed to delete certification with ID: ' . $certId);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete certification']);
        }
    }

    /**
     * Return the Contact Info data.
     *
     * @return \CodeIgniter\HTTP\Response
     */
    public function getContactInfo()
    {
        $contactModel = new \App\Models\Contact();
        $contactInfo = $contactModel->first(); // Assuming there's only one contact info record
        return $this->response->setJSON(['contactInfo' => $contactInfo]);
    }

    public function updateContactInfo()
    {
        $contactModel = new \App\Models\Contact();
        $data = [
            'id' => 1, // Assuming there's only one contact info record
            'contactName' => htmlspecialchars($this->request->getPost('contactName')),
            'contactPhone' => htmlspecialchars($this->request->getPost('contactPhone')),
            'contactEmail' => htmlspecialchars($this->request->getPost('contactEmail')),
            'contactLinkedIn' => htmlspecialchars($this->request->getPost('contactLinkedIn')),
            'contactGitHub' => htmlspecialchars($this->request->getPost('contactGitHub')),
            'contactTwitter' => htmlspecialchars($this->request->getPost('contactTwitter')),
        ];

        // Validate required fields
        foreach ($data as $key => $value) {
            if (empty($value) && !in_array($key, ['contactLinkedIn', 'contactGitHub', 'contactTwitter'])) {
                return $this->response->setJSON(['status' => 'error', 'message' => ucfirst($key) . ' cannot be empty']);
            }
        }

        if ($contactModel->replace($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Contact info updated successfully']);
        } else {
            log_message('error', 'Validation errors: ' . json_encode($contactModel->errors()));
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update contact info']);
        }
    }


}
