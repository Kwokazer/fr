<?php include __DIR__ . '/../header.php'; ?>
    <h1>Создание новой статьи</h1>
    <?php if(!empty($error)): ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    <form class="form" action="add" method="post">
        <label for="name">Название статьи</label><br>
        <input style="border: 0; box-shadow:0 0 15px 4px rgba(0,0,0,0.1); outline: none" type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>" size="50%"><br>
        <br>
        <label for="text">Текст статьи</label><br>
        <textarea style="border: 0; box-shadow:0 0 15px 4px rgba(0,0,0,0.1); outline: none" name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea><br>
        <input type="submit" value="Создать">
    </form>
<?php include __DIR__ . '/../footer.php'; ?>