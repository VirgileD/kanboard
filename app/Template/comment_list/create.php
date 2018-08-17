<div class="page-header">
    <h2><?= t('Add a comment') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('CommentListController', 'save', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->textEditor('comment', array('project_id' => $task['project_id']), array(), array('required' => true)) ?>
    <?= $this->comment->renderTimeSpentField($values, $errors, array('maxlength="6"')) ?>
    <?= $this->modal->submitButtons() ?>
</form>
