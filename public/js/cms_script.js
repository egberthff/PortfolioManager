 // Navigation tab switching
  const navItems = document.querySelectorAll('nav.side-nav li');
  const contentSections = document.querySelectorAll('section.content-section');

  navItems.forEach(item => {
    item.addEventListener('click', () => {
      activateNavItem(item);
    });
    item.addEventListener('keypress', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        activateNavItem(item);
      }
    });
  });

  function activateNavItem(selectedItem) {
    navItems.forEach(item => item.classList.remove('active'));
    selectedItem.classList.add('active');

    const sectionToShow = selectedItem.dataset.section;
    contentSections.forEach(section => {
      if (section.id === sectionToShow) {
        section.hidden = false;
        section.focus();
      } else {
        section.hidden = true;
      }
    });
  }

  // Logout placeholder
  function logout() {
    alert('Logout functionality to be implemented.');
    // Redirect to login page or clear tokens, etc.
  }

  // === About Me Management ===
  const aboutForm = document.getElementById('aboutForm');
  const aboutTextArea = document.getElementById('aboutText');

  aboutForm.addEventListener('submit', (evt) => {
    evt.preventDefault();
    const aboutText = aboutTextArea.value.trim();
    if (!aboutText) {
      alert('Please enter about me text.');
      return;
    }
    // TODO: Send "aboutText" to backend API to save
    $.ajax({
        type: 'post',
        url: 'http://192.168.100.15:8079/portfolio/public/cms-about',
        data: {aboutText: aboutText},
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                showNotification('success', response.message);
            } else {
                showNotification('error', response.message);
            }
        },
        error: function(xhr, status, error) {
            showNotification('error', 'An error occurred while updating About Me.');
        }
    });
  });

  // === Skills Management ===
  const skillsListEl = document.getElementById('skillsList');
  const addSkillBtn = document.getElementById('addSkillBtn');
  const skillEditForm = document.getElementById('skillEditForm');
  const skillNameInput = document.getElementById('skillName');
  const cancelSkillEditBtn = document.getElementById('cancelSkillEditBtn');
  let skills = [];
  let editSkillIndex = null;

  addSkillBtn.addEventListener('click', () => {
    skillEditForm.hidden = false;
    skillNameInput.value = '';
    skillNameInput.focus();
    skillEditForm.querySelector('#skillId').value = ''; // Clear hidden ID input
    skillEditForm.querySelector('input').focus();
    addSkillBtn.disabled = true;
  });

  cancelSkillEditBtn.addEventListener('click', () => {
    skillEditForm.hidden = true;
    addSkillBtn.disabled = false;
    editSkillIndex = null;
  });

  skillEditForm.addEventListener('submit', (evt) => {
    evt.preventDefault();

    const skillName = skillNameInput.value.trim();
    if (!skillName) {
      alert('Skill name cannot be empty.');
      return;
    }

    if (editSkillIndex === null) {
      // Add new skill
      skills.push(skillName);
    } else {
      // Edit existing
      skills[editSkillIndex] = skillName;
    }
    skillEditForm.hidden = true;
    addSkillBtn.disabled = false;
    editSkillIndex = null;
    getSkills();
    // TODO: Persist skills array to backend API
    addSkill(skillName);
  });

 
  // === Experience Management ===
  const experienceListEl = document.getElementById('experienceList');
  const addExperienceBtn = document.getElementById('addExperienceBtn');
  const experienceEditForm = document.getElementById('experienceEditForm');
  const cancelExperienceEditBtn = document.getElementById('cancelExperienceEditBtn');

  let experiences = [];
  let editExperienceIndex = null;

  addExperienceBtn.addEventListener('click', () => {
    experienceEditForm.reset();
    experienceEditForm.hidden = false;
    addExperienceBtn.disabled = true;
    experienceEditForm.querySelector('#expId').value = ''; // Clear hidden ID input
    experienceEditForm.querySelector('input, textarea').focus();
  });

  cancelExperienceEditBtn.addEventListener('click', () => {
    experienceEditForm.hidden = true;
    addExperienceBtn.disabled = false;
    editExperienceIndex = null;
  });

  experienceEditForm.addEventListener('submit', evt => {
    evt.preventDefault();
    const jobTitle = document.getElementById('expJobTitle').value.trim();
    const company = document.getElementById('expCompany').value.trim();
    const location = document.getElementById('expLocation').value.trim();
    const date = document.getElementById('expStartDate').value.trim();
    const endDate = document.getElementById('expEndDate').value.trim();
    const description = document.getElementById('expDescription').value.trim();

    const formData = {
      id: document.getElementById('expId').value || null, // Use hidden input for ID
      expJobTitle: jobTitle,
      expCompany: company,
      expLocation: location,
      expStartDate: date,
      expEndDate: endDate || null, // Allow end date to be optional
      expDescription: description
    };

    experienceEditForm.hidden = true;
    addExperienceBtn.disabled = false;
    editExperienceIndex = null;
    addExperience(formData);
    getExperience();
  });

  function renderExperiences(response) {
    experienceListEl.innerHTML = '';

    response.experience.forEach((exp, idx) => {
      const div = document.createElement('div');
      div.className = 'item-card';

      const h3 = document.createElement('h3');
      h3.textContent = exp.expJobTitle;
      h3.style.color = '#0266d4';

      const companyDiv = document.createElement('div');
      companyDiv.textContent = exp.expCompany;
      companyDiv.style.fontStyle = 'italic';
      companyDiv.style.color = '#555';
      companyDiv.style.marginBottom = '4px';

      const locationDateDiv = document.createElement('div');
      locationDateDiv.textContent = `${exp.expLocation} | ${exp.expStartDate} - ${exp.expEndDate ?? 'Present'}`;
      locationDateDiv.style.fontSize = '0.9rem';
      locationDateDiv.style.color = '#777';
      locationDateDiv.style.marginBottom = '10px';

      const descP = document.createElement('p');
      descP.textContent = exp.expDescription;
      descP.style.color = '#555';

      const editBtn = document.createElement('button');
      editBtn.textContent = '✏';
      editBtn.title = 'Edit Certification';
      editBtn.classList.add('edit-btn');
      editBtn.addEventListener('click', () => {
        experienceEditForm.hidden = false;
        document.getElementById('expId').value = exp.id;
        document.getElementById('expJobTitle').value = exp.expJobTitle;
        document.getElementById('expCompany').value = exp.expCompany;
        document.getElementById('expLocation').value = exp.expLocation;
        document.getElementById('expStartDate').value = exp.expStartDate;
        document.getElementById('expEndDate').value = exp.expEndDate || '';
        document.getElementById('expDescription').value = exp.expDescription;
        addExperienceBtn.disabled = true;
      });

      const deleteBtn = document.createElement('button');
      deleteBtn.innerHTML = '×';
      deleteBtn.title = 'Delete Experience';
      deleteBtn.className = 'delete-btn';
      deleteBtn.addEventListener('click', () => {
        if (confirm('Are you sure you want to delete this experience?')) {
          deleteExperience(exp.id);
        }
      });

      div.appendChild(h3);
      div.appendChild(companyDiv);
      div.appendChild(locationDateDiv);
      div.appendChild(descP);
      div.appendChild(editBtn);
      div.appendChild(deleteBtn);
      div.style.position = 'relative';

      experienceListEl.appendChild(div);
    });
  }

  // === Projects Management ===
  const projectsListEl = document.getElementById('projectsList');
  const addProjectBtn = document.getElementById('addProjectBtn');
  const projectEditForm = document.getElementById('projectEditForm');
  const cancelProjectEditBtn = document.getElementById('cancelProjectEditBtn');

  let projects = [];
  let editProjectIndex = null;

  addProjectBtn.addEventListener('click', () => {
    projectEditForm.reset();
    projectEditForm.hidden = false;
    addProjectBtn.disabled = true;
    projectEditForm.querySelector('#projectId').value = ''; // Clear hidden ID input
    projectEditForm.querySelector('input, textarea').focus();
  });

  cancelProjectEditBtn.addEventListener('click', () => {
    projectEditForm.hidden = true;
    addProjectBtn.disabled = false;
    editProjectIndex = null;
  });

  projectEditForm.addEventListener('submit', evt => {
    evt.preventDefault();

    const id = document.getElementById('projectId').value || null; // Use hidden input for ID
    const title = document.getElementById('projectTitle').value.trim();
    const description = document.getElementById('projectDescription').value.trim();
    const url = document.getElementById('projectUrl').value.trim();
    const demo_url = document.getElementById('projectDemoUrl').value.trim();


    if (!title || !description) {
      alert('Please provide project title and description.');
      return;
    }

    const projectData = {
      id: id,
      projectTitle: title,
      projectDescription: description,
      repo_url: url || null, // Allow URL to be optional
      demo_url: demo_url || null // Allow demo URL to be optional
    };
   
    projectEditForm.hidden = true;
    addProjectBtn.disabled = false;
    editProjectIndex = null;
    addProject(projectData);
    getProjects();
    // renderProjects();
    // TODO: Persist projects to backend API
  });

  function renderProjects(projects) {
    projectsListEl.innerHTML = '';
    projects.forEach((proj, idx) => {
      const div = document.createElement('div');
      div.className = 'item-card';

      const h4 = document.createElement('h4');
      h4.textContent = proj.projectTitle;
      h4.style.color = '#014a9c';
      h4.style.marginBottom = '8px';

      const descP = document.createElement('p');
      descP.textContent = proj.projectDescription;
      descP.style.color = '#555';

      div.appendChild(h4);
      div.appendChild(descP);

      if (proj.repo_url) {
        const a = document.createElement('a');
        a.href = proj.repo_url;
        a.target = '_blank';
        a.rel = 'noopener';
        a.textContent = 'Project Link';
        a.style.display = 'inline-block';
        a.style.marginTop = '12px';
        a.style.fontWeight = '600';
        a.style.color = '#0266d4';
        a.addEventListener('mouseover', () => a.style.color = '#014a9c');
        a.addEventListener('mouseout', () => a.style.color = '#0266d4');
        div.appendChild(a);
      }

      if (proj.demo_url) {
        const a = document.createElement('a');
        a.href = proj.demo_url;
        a.target = '_blank';
        a.rel = 'noopener';
        a.textContent = 'Demo Link';
        a.style.display = 'inline-block';
        a.style.marginTop = '12px';
        a.style.fontWeight = '600';
        a.style.color = '#0266d4';
        a.addEventListener('mouseover', () => a.style.color = '#014a9c');
        a.addEventListener('mouseout', () => a.style.color = '#0266d4');
        div.appendChild(a);
      }

      const editBtn = document.createElement('button');
      editBtn.textContent = '✏';
      editBtn.title = 'Edit Certification';
      editBtn.classList.add('edit-btn');
      editBtn.addEventListener('click', () => {
        projectEditForm.hidden = false;
        document.getElementById('projectId').value = proj.id || '';
        document.getElementById('projectTitle').value = proj.projectTitle;
        document.getElementById('projectDescription').value = proj.projectDescription;
        document.getElementById('projectUrl').value = proj.repo_url || '';
        document.getElementById('projectDemoUrl').value = proj.demo_url || '';
        addProjectBtn.disabled = true;
        editProjectIndex = idx;
      });

      const deleteBtn = document.createElement('button');
      deleteBtn.innerHTML = '×';
      deleteBtn.title = 'Delete Project';
      deleteBtn.className = 'delete-btn';
      deleteBtn.addEventListener('click', () => {
        if (confirm('Are you sure you want to delete this project?')) {
            deleteProject(proj.id);
        }
      });

      div.appendChild(editBtn);
      div.appendChild(deleteBtn);
      div.style.position = 'relative';

      projectsListEl.appendChild(div);
    });
  }

  // === Education Management ===
  const educationListEl = document.getElementById('educationList');
  const addEducationBtn = document.getElementById('addEducationBtn');
  const educationEditForm = document.getElementById('educationEditForm');
  const cancelEducationEditBtn = document.getElementById('cancelEducationEditBtn');


  addEducationBtn.addEventListener('click', () => {
    educationEditForm.reset();
    educationEditForm.hidden = false;
    addEducationBtn.disabled = true;
    educationEditForm.querySelector('#eduId').value = ''; // Clear hidden ID input
    educationEditForm.querySelector('input').focus();
  });

  cancelEducationEditBtn.addEventListener('click', () => {
    educationEditForm.hidden = true;
    addEducationBtn.disabled = false;
    editEducationIndex = null;
  });

  educationEditForm.addEventListener('submit', evt => {
    evt.preventDefault();

    const id = document.getElementById('eduId').value || null; // Use hidden input for ID
    const degree = document.getElementById('eduDegree').value.trim();
    const startDate = document.getElementById('eduStartDate').value.trim();
    const endDate = document.getElementById('eduEndDate').value.trim();
    const school = document.getElementById('eduSchool').value.trim();

    if (!degree || !startDate || !school) {
      alert('Please fill all fields for education.');
      return;
    }

    const eduData = {
      id: id,
      eduDegree: degree,
      eduStartDate: startDate,
      eduEndDate: endDate || null, // Allow end date to be optional
      eduSchool: school
    };

    educationEditForm.hidden = true;
    addEducationBtn.disabled = false;
    editEducationIndex = null;
    addEducation(eduData);
    
  });

  function renderEducations(educations) {
    educationListEl.innerHTML = '';
    educations.forEach((edu, idx) => {
      const div = document.createElement('div');
      div.className = 'item-card';

      const h4 = document.createElement('h4');
      h4.textContent = edu.eduDegree;
      h4.style.color = '#0266d4';

      const durationDiv = document.createElement('div');
      durationDiv.textContent = `${edu.eduStartDate.slice(0, 7)} - ${edu.eduEndDate ? edu.eduEndDate.slice(0, 7) : 'Present'}`;
      durationDiv.style.fontStyle = 'italic';
      durationDiv.style.color = '#666';

      const schoolP = document.createElement('p');
      schoolP.textContent = edu.eduSchool;
      schoolP.style.color = '#444';

      const editBtn = document.createElement('button');
      editBtn.textContent = '✏';
      editBtn.title = 'Edit Certification';
      editBtn.classList.add('edit-btn');
      editBtn.addEventListener('click', () => {
        educationEditForm.hidden = false;
        document.getElementById('eduId').value = edu.id || '';
        document.getElementById('eduDegree').value = edu.eduDegree;
        document.getElementById('eduStartDate').value = edu.eduStartDate;
        document.getElementById('eduEndDate').value = edu.eduEndDate || '';
        document.getElementById('eduSchool').value = edu.eduSchool;
        addEducationBtn.disabled = true;
        editEducationIndex = idx;
      });

      const deleteBtn = document.createElement('button');
      deleteBtn.innerHTML = '×';
      deleteBtn.title = 'Delete Education';
      deleteBtn.className = 'delete-btn';
      deleteBtn.addEventListener('click', () => {
        if (confirm('Are you sure you want to delete this education entry?')) {
          deleteEducation(edu.id);
        }
      });

      div.appendChild(h4);
      div.appendChild(durationDiv);
      div.appendChild(schoolP);
      div.appendChild(editBtn);
      div.appendChild(deleteBtn);
      div.style.position = 'relative';

      educationListEl.appendChild(div);
    });
  }

  // === Certifications Management ===
  const certificationsListEl = document.getElementById('certificationsList');
  const addCertificationBtn = document.getElementById('addCertificationBtn');
  const certificationEditForm = document.getElementById('certificationEditForm');
  const cancelCertificationEditBtn = document.getElementById('cancelCertificationEditBtn');

  addCertificationBtn.addEventListener('click', () => {
    certificationEditForm.reset();
    certificationEditForm.hidden = false;
    addCertificationBtn.disabled = true;
    certificationEditForm.querySelector('#certId').value = ''; // Clear hidden ID input
    certificationEditForm.querySelector('input').focus();
  });

  cancelCertificationEditBtn.addEventListener('click', () => {
    certificationEditForm.hidden = true;
    addCertificationBtn.disabled = false;
    editCertificationIndex = null;
  });

  certificationEditForm.addEventListener('submit', evt => {
    evt.preventDefault();

    const id = document.getElementById('certId').value || null; // Use hidden input for ID
    const title = document.getElementById('certTitle').value.trim();
    const date = document.getElementById('certDate').value.trim();

    if (!title || !date) {
      alert('Please fill all fields for certification.');
      return;
    }

    const certData = {
      id: id,
      certTitle: title,
      certDate: date
    };

    certificationEditForm.hidden = true;
    addCertificationBtn.disabled = false;
    editCertificationIndex = null;
    addCertification(certData);
  });

  function renderCertifications(certifications) {
    certificationsListEl.innerHTML = '';
    certifications.forEach((cert, idx) => {
      const div = document.createElement('div');
      div.className = 'item-card';

      const h4 = document.createElement('h4');
      h4.textContent = cert.certTitle;
      h4.style.color = '#0266d4';

      const dateDiv = document.createElement('div');
      dateDiv.textContent = `Issued: ${cert.certDate}`;
      dateDiv.style.fontStyle = 'italic';
      dateDiv.style.color = '#666';

      const editBtn = document.createElement('button'); 
      editBtn.textContent = '✏';
      editBtn.title = 'Edit Certification';
      editBtn.classList.add('edit-btn');
      editBtn.addEventListener('click', () => {
        certificationEditForm.hidden = false;
        document.getElementById('certId').value = cert.id || '';
        document.getElementById('certTitle').value = cert.certTitle;
        document.getElementById('certDate').value = cert.certDate;
        addCertificationBtn.disabled = true;
      });

      const deleteBtn = document.createElement('button');
      deleteBtn.innerHTML = '×';
      deleteBtn.title = 'Delete Certification';
      deleteBtn.className = 'delete-btn';
      deleteBtn.addEventListener('click', () => {
        if (confirm('Are you sure you want to delete this certification?')) {
          deleteCertification(cert.id);
        }
      });

      div.appendChild(h4);
      div.appendChild(dateDiv);
      div.appendChild(editBtn);
      div.appendChild(deleteBtn);
      div.style.position = 'relative';

      certificationsListEl.appendChild(div);
    });
  }

  // === Contact Info Management ===
  const contactInfoForm = document.getElementById('contactInfoForm');

  contactInfoForm.addEventListener('submit', evt => {
    evt.preventDefault();

    const fullname = contactInfoForm.contactName.value.trim();
    const phone = contactInfoForm.contactPhone.value.trim();
    const email = contactInfoForm.contactEmail.value.trim();
    const linkedin = contactInfoForm.contactLinkedIn.value.trim();
    const github = contactInfoForm.contactGitHub.value.trim();
    const twitter = contactInfoForm.contactTwitter.value.trim();

    if (!email) {
      alert('Email address is required.');
      return;
    }

   const data = {
      contactName: fullname,
      contactPhone: phone || null,
      contactEmail: email,
      contactLinkedIn: linkedin || null,
      contactGitHub: github || null,
      contactTwitter: twitter || null
    };

    updateContactInfo(data);
  });

  // === Initialization (placeholder for fetching data from backend) ===
  function initializeData() {
    $('[data-section="about-section"]').click();
    $('[name="aboutText"').focus();
  }

  // Call initialize on page load
  window.addEventListener('load', initializeData);
