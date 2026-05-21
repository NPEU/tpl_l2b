<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;

$doc   = Factory::getDocument();
#$doc->header_cta = array('text' => Text::_('COM_USERS_Edit_Profile'), 'url' => '/user-profile/edit/'.  $this->data->id);
#$doc->header_cta = array('text' => Text::_('COM_USERS_Edit_Profile'), 'url' => '/user-profile/edit/');
?>
<?php #echo TplL2BHelper::get_messages(); ?>

<div class="l-box  l-box--space--edge  elastipad">
    <div class="panel">
        <?php echo $this->loadTemplate('core'); ?>

        <?php #echo $this->loadTemplate('params'); ?>

        <?php echo $this->loadTemplate('custom'); ?>

        <?php if (Factory::getUser()->id == $this->data->id) : ?>

        <?php endif; ?>
        <p>
            <a href="/user-profile/edit"><?php echo Text::_('COM_USERS_Edit_Profile'); ?></a>
        </p>
    </div>
</div>