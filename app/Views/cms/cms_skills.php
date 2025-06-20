<section class="content-section" id="skills-section" hidden tabindex="0">
    <h2>Skills</h2>
    <div class="item-list" id="skillsList" aria-live="polite" aria-relevant="all"></div>
    <div class="add-btn-container">
      <button id="addSkillBtn" class="btn" type="button">+ Add Skill</button>
    </div>
    <form id="skillEditForm" hidden>
      <label for="skillName">Skill Name</label>
      <input type="hidden" id="skillId" name="skillId"/>
      <input type="text" id="skillName" name="skillName" required />
      <button type="submit">Save Skill</button>
      <button type="button" id="cancelSkillEditBtn" class="btn" style="background:#777;margin-left:10px;">Cancel</button>
    </form>
  </section>