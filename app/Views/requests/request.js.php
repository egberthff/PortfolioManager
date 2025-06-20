 <script>
     //function to handle getting the about me text
     function getaboutMe() {
         $.ajax({
             type: 'get',
             url: '<?= site_url('cms-about') ?>',
             responseType: 'json',
             success: function(response) {
                 if (response) {
                     $('[name="aboutText"]').html(response.aboutText);
                 } else {
                     $('[name="aboutText"]').html("");
                 }
             },
         })
     }

     function getSkills() {
         $.ajax({
             type: 'get',
             url: '<?= site_url('cms-skills') ?>',
             dataType: 'json',
             success: function(response) {
                 const $skillsList = $('#skillsList');
                 $skillsList.empty(); // Clear the skills list

                 if (response.skills && response.skills.length > 0) {
                     response.skills.forEach(function(skill, index) {
                         const $div = $('<div></div>')
                             .addClass('item-card')
                             .css('position', 'relative')
                             .text(skill['skillName']);

                         const $editBtn = $('<button></button>')
                             .text('✏')
                             .attr('title', 'Edit Skill')
                             .addClass('edit-btn')
                             .on('click', function() {
                                 $('#skillEditForm').prop('hidden', false);
                                 $('#skillId').val(skill['id']);
                                 $('#skillName').val(skill['skillName']).focus();
                                 $('#addSkillBtn').prop('disabled', true);
                                 editSkillIndex = index;
                             });

                         const $deleteBtn = $('<button></button>')
                             .html('&times;')
                             .attr('title', 'Delete Skill')
                             .addClass('delete-btn')
                             .on('click', function() {
                                 if (confirm('Are you sure you want to delete this skill?')) {
                                     deleteSkill(skill['id']);
                                     getSkills();
                                 }
                             });

                         $div.append($editBtn, $deleteBtn);
                         $skillsList.append($div);
                     });
                 } else {
                     $skillsList.html('<p>No skills available.</p>');
                 }
             },
             error: function(xhr, status, error) {
                 console.error('Error fetching skills:', error);
                 showNotification('error', 'Failed to load skills.');
             }
         });
     }


     //function to handle adding/updating a new skill
     function addSkill(skill) {
         $.ajax({
             type: 'post',
             url: '<?= site_url('cms-add-skill') ?>',
             data: {
                 skillName: skill,
                 skillId: $('#skillId').val() || null // Use the hidden input for skill ID
             },
             dataType: 'json',
             success: function(response) {
                 if (response.status === 'success') {
                     showNotification('success', response.message);
                     getSkills(); // Refresh the skills list
                 } else {
                     showNotification('error', response.message);
                 }
             },
             error: function(xhr, status, error) {
                 console.error('Error adding skill:', error);
                 showNotification('error', 'Failed to add skill.');
             }
         });
     }

     //function to handle deletion of a skill
        function deleteSkill(skillId) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-delete-skill') ?>',
                data: { skillId: skillId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getSkills(); // Refresh the skills list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting skill:', error);
                    showNotification('error', 'Failed to delete skill.');
                }
            });
        }

        //function to handle getting experience data
     function getExperience() {
         $.ajax({
             type: 'get',
             url: '<?= site_url('cms-experience') ?>',
             dataType: 'json',
             success: function(response) {
                 const $experienceList = $('#experienceList');
                 $experienceList.empty(); // Clear the experience list
                 if (response.experience && response.experience.length > 0) {
                    renderExperiences(response);
                 } else {
                     $experienceList.html('<p>No experience available.</p>');
                 }
             },
             error: function(xhr, status, error) {
                 console.error('Error fetching experience:', error);
                 showNotification('error', 'Failed to load experience.');
             }
         });
        }

        //function to add or update experience
        function addExperience(experience) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-add-experience') ?>',
                data: experience,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getExperience(); // Refresh the experience list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding experience:', error);
                    showNotification('error', 'Failed to add experience.');
                }
            });
        }

        //function to handle deletion of experience
        function deleteExperience(expId) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-delete-experience') ?>',
                data: { expId: expId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getExperience(); // Refresh the experience list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting experience:', error);
                    showNotification('error', 'Failed to delete experience.');
                }
            });
        }

        //function to handle getting projects data
        function getProjects() {
            $.ajax({
                type: 'get',
                url: '<?= site_url('cms-projects') ?>',
                dataType: 'json',
                success: function(response) {
                    const $projectsList = $('#projectsList');
                    $projectsList.empty(); // Clear the projects list
                    if (response.projects && response.projects.length > 0) {
                        renderProjects(response.projects)
                    } else {
                        $projectsList.html('<p>No projects available.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching projects:', error);
                    showNotification('error', 'Failed to load projects.');
                }
            });
        }

        //function to handle add or update of a project
        function addProject(project) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-add-project') ?>',
                data: project,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getProjects(); // Refresh the projects list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding project:', error);
                    showNotification('error', 'Failed to add project.');
                }
            });
        }

        //function to handle deletion of a project
        function deleteProject(projectId) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-delete-project') ?>',
                data: { projectId: projectId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getProjects(); // Refresh the projects list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting project:', error);
                    showNotification('error', 'Failed to delete project.');
                }
            });
        }

        //function to handle getting education data
     function getEducation() {
         $.ajax({
             type: 'get',
             url: '<?= site_url('cms-education') ?>',
             dataType: 'json',
             success: function(response) {
                 const $educationList = $('#educationList');
                 $educationList.empty(); // Clear the education list
                 if (response.education && response.education.length > 0) {
                     renderEducations(response.education);
                    } else {
                        $educationList.html('<p>No education available.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching education:', error);
                    showNotification('error', 'Failed to load education.');
                }
            });
        }

        //function to handle adding or updating education data
        function addEducation(education) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-add-education') ?>',
                data: education,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getEducation(); // Refresh the education list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding education:', error);
                    showNotification('error', 'Failed to add education.');
                }
            });
        }

        //function to handle deletion of education data
        function deleteEducation(eduId) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-delete-education') ?>',
                data: { eduId: eduId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getEducation(); // Refresh the education list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting education:', error);
                    showNotification('error', 'Failed to delete education.');
                }
            });
        }

    //function to handle getting certifications data
        function getCertifications() {
            $.ajax({
                type: 'get',
                url: '<?= site_url('cms-certifications') ?>',
                dataType: 'json',
                success: function(response) {
                    const $certificationsList = $('#certificationsList');
                    $certificationsList.empty(); // Clear the certifications list
                    if (response.certifications && response.certifications.length > 0) {
                        renderCertifications(response.certifications);
                    } else {
                        $certificationsList.html('<p>No certifications available.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching certifications:', error);
                    showNotification('error', 'Failed to load certifications.');
                }
            });
        }

        //function to handle adding or updating a certification
        function addCertification(certification) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-add-certification') ?>',
                data: certification,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getCertifications(); // Refresh the certifications list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error adding certification:', error);
                    showNotification('error', 'Failed to add certification.');
                }
            });
        }

        //function to handle deletion of a certification
        function deleteCertification(certId) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-delete-certification') ?>',
                data: { certId: certId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getCertifications(); // Refresh the certifications list
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting certification:', error);
                    showNotification('error', 'Failed to delete certification.');
                }
            });
        }

        //function to handle getting contact info
        function getContactInfo() {
            $.ajax({
                type: 'get',
                url: '<?= site_url('cms-contact') ?>',
                dataType: 'json',
                success: function(response) {
                    if (response.contactInfo) {
                        $('#contactEmail').val(response.contactInfo.contactEmail);
                        $('#contactPhone').val(response.contactInfo.contactPhone);
                        $('#contactAddress').val(response.contactInfo.contactAddress);
                        $('#contactName').val(response.contactInfo.contactName);
                        $('#contactLinkedIn').val(response.contactInfo.contactLinkedIn);
                        $('#contactGitHub').val(response.contactInfo.contactGitHub);
                        $('#contactTwitter').val(response.contactInfo.contactTwitter);
                        $('#contactId').val(response.contactInfo.id);
                    } else {
                        $('#contactEmail, #contactPhone, #contactAddress').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching contact info:', error);
                    showNotification('error', 'Failed to load contact info.');
                }
            });
        }

        //function to handle updating contact info
        function updateContactInfo(contactInfo) {
            $.ajax({
                type: 'post',
                url: '<?= site_url('cms-update-contact') ?>',
                data: contactInfo,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        getContactInfo(); // Refresh the contact info
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating contact info:', error);
                    showNotification('error', 'Failed to update contact info.');
                }
            });
        }


















     //function to handle showing notification modal
     function showNotification(status, message) {
         const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
         const header = document.getElementById('notificationModalHeader');
         const body = document.getElementById('notificationModalBody');

         // Update modal style and message
         if (status === 'success') {
             header.classList.remove('bg-danger');
             header.classList.add('bg-success', 'text-white');
         } else {
             header.classList.remove('bg-success');
             header.classList.add('bg-danger', 'text-white');
         }

         body.textContent = message;

         setTimeout(() => {
             modal.hide();
         }, 3000);

         // Show the modal
         modal.show();
     }
 </script>