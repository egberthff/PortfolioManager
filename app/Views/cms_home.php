<?= $this->extend('layout/cms_main') ?>

<?= $this->section('cms_content') ?>
  <?= $this->include('cms/cms_nav') ?>
  <?= $this->include('cms/cms_about') ?>
  <?= $this->include('cms/cms_skills') ?>
  <?= $this->include('cms/cms_experience') ?>
  <?= $this->include('cms/cms_education') ?>
  <?= $this->include('cms/cms_projects') ?>
  <?= $this->include('cms/cms_certifications') ?>
  <?= $this->include('cms/cms_contact') ?>
<?= $this->endSection() ?>
