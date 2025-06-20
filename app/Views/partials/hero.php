<section id="hero" role="banner" aria-label="Introduction">
  <h2 class="visually-hidden"><?= esc($contact['contactTitle'] ?? 'Welcome to My Portfolio') ?>, I'm</h2>
  <h1><?= esc($contact[0]['contactName'] ?? 'Your Name') ?></h1>
  <p>IT Professional | Software Engineer | Problem Solver</p>
  <button class="btn" onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'});">Get in Touch</button>
</section>