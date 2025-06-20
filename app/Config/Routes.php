<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/{any}', 'Portfolio::index');
$routes->get('projects', 'Portfolio::projects');
$routes->get('contact', 'Portfolio::contact');
$routes->post('contact/submit', 'Portfolio::submitContact');

$routes->get('cms-admin-panel', 'AdminPanel::index');
$routes->get('cms-admin-login', 'Auth::index');
$routes->post('cms-admin-login', 'Auth::login');
$routes->get('cms-admin-logout', 'Auth::logout');

$routes->post('cms-about', 'AdminPanel::updateAboutMe');
$routes->get('cms-about', 'AdminPanel::getAboutMe');

$routes->get('cms-skills', 'AdminPanel::getSkills');
$routes->post('cms-add-skill', 'AdminPanel::addSkill');
$routes->post('cms-delete-skill', 'AdminPanel::deleteSkill');

$routes->get('cms-experience', 'AdminPanel::getExperience');
$routes->post('cms-add-experience', 'AdminPanel::addExperience');
$routes->post('cms-delete-experience', 'AdminPanel::deleteExperience');

$routes->get('cms-projects', 'AdminPanel::getProjects');
$routes->post('cms-add-project', 'AdminPanel::addProject');
$routes->post('cms-delete-project', 'AdminPanel::deleteProject');

$routes->get('cms-education', 'AdminPanel::getEducation');
$routes->post('cms-add-education', 'AdminPanel::addEducation');
$routes->post('cms-delete-education', 'AdminPanel::deleteEducation');

$routes->get('cms-certifications', 'AdminPanel::getCertifications');
$routes->post('cms-add-certification', 'AdminPanel::addCertification');
$routes->post('cms-delete-certification', 'AdminPanel::deleteCertification');

$routes->get('cms-contact', 'AdminPanel::getContactInfo');
$routes->post('cms-update-contact', 'AdminPanel::updateContactInfo');


$routes->get('cms-all-data', 'AllData::index');
