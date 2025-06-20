<section class="content-section" id="education-section" hidden tabindex="0">
    <h2>Education</h2>
    <div class="item-list" id="educationList" aria-live="polite" aria-relevant="all"></div>
    <div class="add-btn-container">
      <button id="addEducationBtn" class="btn" type="button">+ Add Education</button>
    </div>
    <form id="educationEditForm" hidden>
      <input type="hidden" id="eduId" name="id" />
      <label for="eduDegree">Degree</label>
      <input type="text" id="eduDegree" name="eduDegree" required />

      <label for="expDate">Duration</label>
      <div id="expDate" class="date-range-container">
        <div class="date-range">
        <label for="eduStartDate">Start Date</label>
        <input type="date" id="eduStartDate" name="eduStartDate" placeholder="e.g. Jan 2019" required />
        </div>
        
        <div class="date-range">
        <label for="eduEndDate">End Date</label>
        <input type="date" id="eduEndDate" name="eduEndDate" placeholder="e.g. Jan 2023" />
        </div>
      </div>

      <label for="eduSchool">School / University</label>
      <input type="text" id="eduSchool" name="eduSchool" required />

      <button type="submit">Save Education</button>
      <button type="button" id="cancelEducationEditBtn" class="btn" style="background:#777;margin-left:10px;">Cancel</button>
    </form>
  </section>
