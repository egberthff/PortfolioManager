<section id="skills" aria-labelledby="skills-title">
  <h2 id="skills-title" class="section-title">Technical Skills</h2>
  <div class="skills-list" role="list" aria-label="Technical skills list">
    <?php if (!empty($skills) && is_array($skills)) : ?>
      <?php foreach ($skills as $skill) : ?>
        <span class="skill" role="listitem"><?= esc($skill['skillName']) ?></span>
      <?php endforeach; ?>
    <?php else : ?>
      <span class="skill" role="listitem">No skills listed.</span>
    <?php endif; ?>
  </div>
</section>
