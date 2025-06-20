<section id="contact" aria-labelledby="contact-title">
  <h2 id="contact-title" class="section-title">Contact Me</h2>
  <form id="contactForm" aria-describedby="formMessage" novalidate>
    <label for="name">Name *</label>
    <input type="text" id="name" name="name" required aria-required="true" autocomplete="name" />
    <div id="nameError" class="form-error" aria-live="polite"></div>

    <label for="email">Email *</label>
    <input type="email" id="email" name="email" required aria-required="true" autocomplete="email" />
    <div id="emailError" class="form-error" aria-live="polite"></div>

    <label for="message">Message *</label>
    <textarea id="message" name="message" rows="5" required aria-required="true" autocomplete="off"></textarea>
    <div id="messageError" class="form-error" aria-live="polite"></div>

    <button type="submit">Send Message</button>
    <div id="formMessage" class="form-message" role="alert" aria-live="assertive"></div>
  </form>
</section>