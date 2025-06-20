<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Panel - Portfolio Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= site_url('css/cms_style.css') ?>">
</head>
<body>
  <?= $this->include('cms/cms_header') ?>
  <main>
  <?= $this->renderSection('cms_content') ?>
  </main>
    <!-- this is the notification modal -->
    <?= $this->include('layout/notification_modal') ?>
    
    <script src="<?= site_url('js/cms_script.js')?>"></script>
    <?= $this->include('requests/request.js.php') ?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
