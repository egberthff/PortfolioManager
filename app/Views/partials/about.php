<section id="about" aria-labelledby="about-title">
  <h2 id="about-title" class="section-title">About Me</h2>
  <p>
     <?= !empty($about) ? $about[0]['aboutText'] : 'No information available.' ?>
  </p>
</section>