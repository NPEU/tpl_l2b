<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_blockstext
 *
 * @copyright   Copyright (C) NPEU 2026.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

?>

<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>
<?php

$content = explode('<hr id="system-readmore">', trim($module->content)); ?>
<div class="blocks-container blockstext-container">
    <?php echo $content[0]; ?>
    <?php if (!empty($content[1])) : ?>
    <details class="c-disclosure">
        <summary>Read more:</summary>
        <div>
            <?php echo $content[1]; ?>
        </div>
    </details>
    <?php endif; ?>
</div>