<section id="contact">
  <h2>Contact Me</h2>
  
  <?php if (session()->getFlashdata('success')): ?>
    <p class="success"><?= session()->getFlashdata('success') ?></p>
  <?php endif; ?>

  <?php if (session()->getFlashdata('errors')): ?>
    <ul class="errors">
      <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form action="<?= base_url('/send-contact') ?>" method="post">
    <input type="text" name="name" placeholder="Your Name" value="<?= old('name') ?>">
    <input type="email" name="email" placeholder="Your Email" value="<?= old('email') ?>">
    <textarea name="message" placeholder="Your Message"><?= old('message') ?></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>
