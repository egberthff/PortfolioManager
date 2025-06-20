<section id="education" aria-labelledby="education-title">
  <h2 id="education-title" class="section-title">Education</h2>

  <?php if (!empty($education) && is_array($education)) : ?>
    <?php foreach ($education as $edu) : ?>
      <div class="edu-item">
        <h4><?= esc($edu['eduDegree'] ?? 'Degree not specified') ?></h4>
        <div class="edu-duration">
          <?= esc($edu['eduStartDate'] ?? '') ?> - <?= esc($edu['eduEndDate'] ?? 'Present') ?>
        </div>
        <p><?= esc($edu['eduSchool'] ?? 'Institution not specified') ?></p>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <p>No education records available.</p>
  <?php endif; ?>
</section>
