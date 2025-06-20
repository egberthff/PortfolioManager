<section class="content-section" id="contact-section" hidden tabindex="0">
  <h2>Contact Info</h2>
  <form id="contactInfoForm" class="form-container">

    <input type="hidden" name="id" />
    <label for="contactName">Full Name</label>
    <input type="text" id="contactName" name="contactName" required />

    <label for="contactPhone">Phone Number</label>
    <input type="tel" id="contactPhone" name="contactPhone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" />

    <label for="contactEmail">Email Address</label>
    <input type="email" id="contactEmail" name="contactEmail" required />

    <label for="contactLinkedIn">LinkedIn URL</label>
    <input type="url" id="contactLinkedIn" name="contactLinkedIn" placeholder="https://linkedin.com/in/username" />

    <label for="contactGitHub">GitHub URL</label>
    <input type="url" id="contactGitHub" name="contactGitHub" placeholder="https://github.com/username" />

    <label for="contactTwitter">Twitter URL</label>
    <input type="url" id="contactTwitter" name="contactTwitter" placeholder="https://twitter.com/username" />
    <button type="submit">Save Contact Info</button>
  </form>

</section>