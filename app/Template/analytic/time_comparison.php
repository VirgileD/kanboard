<?php if (! $is_ajax): ?>
    <div class="page-header">
        <h2><?= t('Estimated vs Spent') ?></h2>
    </div>
<?php endif ?>

<?php if (empty($metrics)): ?>
    <p class="alert"><?= t('Not enough data to show the graph.') ?></p>
<?php else: ?>
    <?php if ($paginator->isEmpty()): ?>
      <p class="alert"><?= t('No tasks found.') ?></p>
    <?php elseif (! $paginator->isEmpty()): ?>
      <?= $this->app->component('chart-project-time-comparison-by-column', array(
        'metrics' => $metrics
      )) ?>

      <table class="table-fixed table-small table-scrolling">
        <tr>
          <th class="column-5"><?= $paginator->order(t('Id'), 'tasks.id') ?></th>
          <th><?= $paginator->order(t('Title'), 'tasks.title') ?></th>
          <th class="column-12"><?= $paginator->order(t('Estimated'), 'tasks.time_estimated') ?></th>
          <th class="column-12"><?= $paginator->order(t('Spent'), 'tasks.time_spent') ?></th>
        </tr>
        <?php foreach ($paginator->getCollection() as $task): ?>
          <tr>
            <td class="task-table color-<?= $task['color_id'] ?>">
              <?= $this->url->link('#'.$this->text->e($task['id']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', t('View this task')) ?>
            </td>
            <td>
              <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', t('View this task')) ?>
            </td>
            <td>
              <?= $this->dt->spent($task['time_estimated']) ?>
            </td>
            <td>
              <?= $this->dt->spent($task['time_spent']) ?>
            </td>
          </tr>
        <?php endforeach ?>
      </table>

      <?= $paginator ?>
    <?php endif ?>
<?php endif ?>
