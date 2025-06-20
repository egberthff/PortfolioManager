<section class="content-section" id="projects-section" hidden tabindex="0">
    <h2>Projects</h2>
    <div class="item-list" id="projectsList" aria-live="polite" aria-relevant="all"></div>
    <div class="add-btn-container">
      <button id="addProjectBtn" class="btn" type="button">+ Add Project</button>
    </div>
    <form id="projectEditForm" hidden>
      <input type="hidden" id="projectId" name="id" />
      <label for="projectTitle">Project Title</label>
      <input type="text" id="projectTitle" name="projectTitle" required />

      <label for="projectDescription">Description</label>
      <textarea id="projectDescription" name="projectDescription" rows="5" required></textarea>

      <label for="projectUrl">Project URL (e.g., GitHub link)</label>
      <input type="url" id="projectUrl" name="repo_url" placeholder="https://github.com/user/project" />

      <label for="projectDemoUrl">Demo URL (optional)</label>
      <input type="url" id="projectDemoUrl" name="demo_url" placeholder="https://user.github.io/project-demo" />

      <button type="submit">Save Project</button>
      <button type="button" id="cancelProjectEditBtn" class="btn" style="background:#777;margin-left:10px;">Cancel</button>
    </form>
  </section>
