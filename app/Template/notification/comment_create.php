<h2><?= $this->text->e($task['title']) ?> (#<?= $task['id'] ?>)</h2>

<?php if (! empty($comment['username'])): ?>
    <h3><?= t('New comment posted by %s', $comment['name'] ?: $comment['username']) ?></h3>
<?php else: ?>
    <h3><?= t('New comment') ?></h3>
<?php endif ?>

<?= $this->text->markdown($comment['comment'], true) ?>
<div><?= $this->dt->spent($comment['time_spent']) ?></div>
<?= $this->render('notification/footer', array('task' => $task)) ?>