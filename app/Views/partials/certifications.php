<section id="certifications" aria-labelledby="certifications-title">
  <h2 id="certifications-title" class="section-title">Certifications</h2>

  <?php if (!empty($certifications) && is_array($certifications)) : ?>
    <?php foreach ($certifications as $cert) : ?>
      <div class="cert-item">
        <h4><?= esc($cert['certTitle'] ?? 'Untitled Certification') ?></h4>
        <div class="cert-duration">
          Issued: <?= esc($cert['certDate'] ?? 'N/A') ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <p>No certifications available.</p>
  <?php endif; ?>
</section>
