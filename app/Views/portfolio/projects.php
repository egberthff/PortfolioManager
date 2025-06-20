<section>
  <h2 class="text-xl font-bold mb-4">My Projects</h2>
  <div class="grid md:grid-cols-2 gap-4">
    <?php foreach ($projects as $project): ?>
      <div class="bg-white p-4 rounded shadow">
        <img src="<?= $project['image_url'] ?>" alt="Project Image" class="mb-2 w-full rounded">
        <h3 class="text-lg font-semibold"><?= esc($project['title']) ?></h3>
        <p><?= esc($project['description']) ?></p>
        <div class="mt-2">
          <a href="<?= $project['demo_url'] ?>" class="text-blue-500 hover:underline mr-2">Live Demo</a>
          <a href="<?= $project['repo_url'] ?>" class="text-blue-500 hover:underline">Source Code</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>