<?php /** @var String $title */ ?>
<?php /** @var Array $news */ ?>

<h2><?= esc($title) ?></h2>

<p><?= getenv('MESSAGE'); ?></p>
<p><?= $_ENV['CI_ENVIRONMENT']; ?></p>

<?php if (! empty($news) && is_array($news)) : ?>
    <?php foreach ($news as $news_item): ?>
        <h3><?= esc($news_item['title']) ?></h3>
        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>
        <p><a href="/news/edit/<?= esc($news_item['id'], 'url') ?>">Edit article</a></p>
        <p><a href="/news/delete/<?= esc($news_item['id'], 'url') ?>">Delete article</a></p>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <h3>No News</h3>
    <p>Unable to find any news for you</p>
<?php endif; ?>
