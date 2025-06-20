<section id="experience" aria-labelledby="experience-title">
  <h2 id="experience-title" class="section-title">Professional Experience</h2>

  <?php if (!empty($experience) && is_array($experience)) : ?>
    <?php foreach ($experience as $job) : ?>
      <article class="job" role="article" aria-label="<?= esc($job['expJobTitle'] ?? 'Job Title') ?> at <?= esc($job['expCompany'] ?? 'Company') ?>">
        <h3><?= esc($job['expJobTitle'] ?? 'Job Title') ?></h3>
        <div class="job-title"><?= esc($job['expCompany'] ?? 'Company') ?> - <?= esc($job['expLocation'] ?? 'Location') ?></div>
        <div class="date-location"><?= esc($job['expStartDate'] ?? 'Start') ?> - <?= esc($job['expEndDate'] ?? 'Present') ?></div>
        <p><?= esc($job['expDescription'] ?? 'No description provided.') ?></p>
      </article>
    <?php endforeach; ?>
  <?php else : ?>
    <p>No professional experience records available.</p>
  <?php endif; ?>
</section>
