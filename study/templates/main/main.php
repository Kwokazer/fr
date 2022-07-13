    <?php include __DIR__.'/../header.php';?>
        <?php foreach ($articles as $article):?>
            <h2><a href="articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
            <p><?= $article->getText() ?></p>
            <a href="articles/<?= $article->getId() ?>/edit">Редактировать</a>
            <hr>
            
            <br>
        <?php endforeach ?>
        <a href="articles/add">Добавить запись</a>
    <?php include __DIR__.'/../footer.php';?>