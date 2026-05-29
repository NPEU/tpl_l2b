<?php
/**
 * @author      Lefteris Kavadas
 * @copyright   Copyright (c) 2016 - 2026 Lefteris Kavadas / firecoders.com
 * @license     GNU General Public License version 3 or later
 */

use Joomla\CMS\Language\Text;

\defined('_JEXEC') or die;

extract($displayData);
?>
<div id="comments" class="l-box  l-box--space--edge">
    <h3><?php echo Text::_('COM_COMMENTBOX_COMMENTS'); ?></h3>

    <?php echo $commentboxBefore; ?>

    <div id="commentbox" class="">
        <template shadowrootmode="open">
            <div id="commentbox-app"></div>
            <style><?php echo $styles; ?></style>
        </template>
    </div>

    <?php echo $commentboxAfter; ?>

</div>