<?php echo view('template/header.php'); ?>
<div class="content-wrapper">







    <h2>Upload File</h2>
    <?php if (session()->has('error')) : ?>
        <p><?= session('error') ?></p>
    <?php endif; ?>
    <form action="<?= site_url('/upload') ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>





    <?php echo view('template/footer.php'); ?>