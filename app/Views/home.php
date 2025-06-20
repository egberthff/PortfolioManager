<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
  <?= $this->include('partials/hero', ['data' => $contact]) ?>
  <?= $this->include('partials/about', ['data' => $about]) ?>
  <?= $this->include('partials/skills', ['data' => $skills]) ?>
  <?= $this->include('partials/experience', ['data' => $experience]) ?>
  <?= $this->include('partials/education', ['data' => $education]) ?>
  <?= $this->include('partials/projects', ['data' => $projects]) ?>
  <?= $this->include('partials/certifications', ['data' => $certifications]) ?>
  <?= $this->include('partials/contact', ['data' => $contact]) ?>
<?= $this->endSection() ?>
