<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

use NPEU\Plugin\System\Blocks\Helper\BlocksHelper;

?>
<?php echo BlocksHelper::renderUse('edit'); ?><span><?php echo Text::_('JGLOBAL_EDIT'); ?></span>
