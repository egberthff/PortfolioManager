<section id="projects" aria-labelledby="projects-title">
  <h2 id="projects-title" class="section-title">Selected Projects</h2>
  <div class="project-list">
    <?php if (!empty($projects) && is_array($projects)) : ?>
      <?php foreach ($projects as $project) : ?>
        <div class="project" role="region" aria-label="Project: <?= esc($project['projectTitle'] ?? 'Untitled Project') ?>">
          <h4><?= esc($project['projectTitle'] ?? 'Untitled Project') ?></h4>
          <p><?= esc($project['projectDescription'] ?? 'No description available.') ?></p>
          <?php if (!empty($project['repo_url'])) : ?>
            <a href="<?= esc($project['repo_url']) ?>" target="_blank" rel="noopener">View on GitHub</a>
          <?php endif; ?>
          <?php if (!empty($project['demo_url'])) : ?>
            <a href="<?= esc($project['demo_url']) ?>" target="_blank" rel="noopener">Live Demo</a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No projects available.</p>
    <?php endif; ?>
  </div>
</section>
