<section class="content-section" id="certifications-section" hidden tabindex="0">
    <h2>Certifications</h2>
    <div class="item-list" id="certificationsList" aria-live="polite" aria-relevant="all"></div>
    <div class="add-btn-container">
      <button id="addCertificationBtn" class="btn" type="button">+ Add Certification</button>
    </div>
    <form id="certificationEditForm" hidden>
      <input type="hidden" id="certId" name="id" />
      <label for="certTitle">Certification Title</label>
      <input type="text" id="certTitle" name="certTitle" required />

      <label for="certDate">Issued Date</label>
      <input type="date" id="certDate" name="certDate" placeholder="e.g. 2020" required />

      <button type="submit">Save Certification</button>
      <button type="button" id="cancelCertificationEditBtn" class="btn" style="background:#777;margin-left:10px;">Cancel</button>
    </form>
  </section>