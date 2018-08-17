<?php

namespace Kanboard\Helper;

use Kanboard\Core\Base;
use Kanboard\Model\UserMetadataModel;

/**
 * Class CommentHelper
 *
 * @package Kanboard\Helper
 * @author  Frederic Guillot
 */
class CommentHelper extends Base
{
    public function toggleSorting()
    {
        $oldDirection = $this->userMetadataCacheDecorator->get(UserMetadataModel::KEY_COMMENT_SORTING_DIRECTION, 'ASC');
        $newDirection = $oldDirection === 'ASC' ? 'DESC' : 'ASC';

        $this->userMetadataCacheDecorator->set(UserMetadataModel::KEY_COMMENT_SORTING_DIRECTION, $newDirection);
    }

    public function renderTimeSpentField(array $values, array $errors = array(), array $attributes = array())
    {
        $html = $this->helper->form->label(t('Time Spent'), 'time_spent');
        $html .= $this->helper->form->numeric('time_spent', $values, $errors, $attributes);

        return $html;
    }
}
