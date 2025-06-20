<section>
  <h2 class="text-xl font-bold mb-4">Contact Me</h2>
  <?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-200 text-green-800 p-2 rounded mb-4 flex items-center justify-between">
      <span><?= session()->getFlashdata('success') ?></span>
      <button onclick="this.parentElement.remove();" class="text-green-900 font-bold ml-2">&times;</button>
    </div>
  <?php elseif (session()->getFlashdata('error')): ?>
    <div class="bg-red-200 text-red-800 p-2 rounded mb-4 flex items-center justify-between">
      <span><?= session()->getFlashdata('error') ?></span>
      <button onclick="this.parentElement.remove();" class="text-red-900 font-bold ml-2">&times;</button>
    </div>
  <?php endif; ?>
  <form action="/contact/submit" method="post" class="max-w-md">
    <input type="text" name="name" placeholder="Your Name" class="block w-full p-2 border border-gray-300 rounded mb-2">
    <input type="email" name="email" placeholder="Your Email" class="block w-full p-2 border border-gray-300 rounded mb-2">
    <textarea name="message" placeholder="Your Message" class="block w-full p-2 border border-gray-300 rounded mb-2"></textarea>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Send</button>
  </form>
</section>