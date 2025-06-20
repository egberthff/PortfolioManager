<section class="content-section" id="experience-section" hidden tabindex="0">
    <h2>Experience</h2>
    <div class="item-list" id="experienceList" aria-live="polite" aria-relevant="all"></div>
    <div class="add-btn-container">
      <button id="addExperienceBtn" class="btn" type="button">+ Add Experience</button>
    </div>
    <form id="experienceEditForm" hidden>
      <input type="hidden" id="expId" name="id" />
      <label for="expJobTitle">Job Title</label>
      <input type="text" id="expJobTitle" name="expJobTitle" required />

      <label for="expCompany">Company</label>
      <input type="text" id="expCompany" name="expCompany" required />

      <label for="expLocation">Location</label>
      <input type="text" id="expLocation" name="expLocation" required />

      <label for="expDate">Date Range</label>
      <div id="expDate" class="date-range-container">
        <div class="date-range">
        <label for="expStartDate">Start Date</label>
        <input type="date" id="expStartDate" name="expStartDate" placeholder="e.g. Jan 2019" required />
        </div>
        
        <div class="date-range">
        <label for="expEndDate">End Date</label>
        <input type="date" id="expEndDate" name="expEndDate" placeholder="e.g. Jan 2023" />
        </div>
      </div>

      <label for="expDescription">Description</label>
      <textarea id="expDescription" name="expDescription" rows="5" required></textarea>

      <button type="submit">Save Experience</button>
      <button type="button" id="cancelExperienceEditBtn" class="btn" style="background:#777;margin-left:10px;">Cancel</button>
    </form>
  </section>