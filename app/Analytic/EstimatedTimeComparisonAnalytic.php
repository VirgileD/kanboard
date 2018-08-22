<?php

namespace Kanboard\Analytic;

use Kanboard\Core\Base;
use Kanboard\Model\TaskModel;
use Kanboard\Model\ColumnModel;
use Kanboard\Model\CommentModel;


  /**
  * Estimated/Spent Time Comparison by column
  *
  * @package  analytic
  * @author   VD
  */
  class EstimatedTimeComparisonAnalytic extends Base
  {
  /**
  * Build report
  *
  * @access public
  * @param  integer   $project_id    Project id
  * @return array
  */
  public function build($project_id)
  {
    $rows = $this->db
        ->table(TaskModel::TABLE)
        ->columns(
          TaskModel::TABLE.'.id',
          TaskModel::TABLE.'.title',
          TaskModel::TABLE.'.date_due',
          TaskModel::TABLE.'.date_started',
          TaskModel::TABLE.'.project_id',
          TaskModel::TABLE.'.color_id',
          TaskModel::TABLE.'.priority',
          '(SELECT SUM(time_spent) FROM '.CommentModel::TABLE.' WHERE task_id=tasks.id) AS time_spent',
          TaskModel::TABLE.'.time_estimated',
          ColumnModel::TABLE.'.title AS column_name'
        )
        ->eq(TaskModel::TABLE.'.project_id', $project_id)
        ->join(ColumnModel::TABLE, 'id', 'column_id', TaskModel::TABLE)
        ->findAll();

    $metrics = array();

    foreach ($rows as $row) {
      if(!isset($metrics[$row['column_name']])) {
        $metrics[$row['column_name']] = array();
      }
      if(!isset($metrics[$row['column_name']]['time_estimated'])) {
        $metrics[$row['column_name']]['time_estimated'] = 0;
      }
      $metrics[$row['column_name']]['time_estimated'] += (int) $row['time_estimated'];
      if(!isset($metrics[$row['column_name']]['time_spent'])) {
        $metrics[$row['column_name']]['time_spent'] = 0;
      }
      $metrics[$row['column_name']]['time_spent'] += (int) $row['time_spent'];
    }
    return $metrics;
  }
}
