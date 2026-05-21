<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_blocksaccordion
 *
 * @copyright   Copyright (C) NPEU 2026.
 * @license     MIT License; see LICENSE.md
 */

\defined('_JEXEC') or die;

?>

<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>
<?php if (!empty($params->get('panels'))) : ?>
<div class="blocks-container blocksaccordion-container">
    <section>
    <?php foreach ($params->get('panels') as $panel) : ?>
    <details class="c-disclosure">
        <summary>
        <?php echo $panel->panel_title; ?>
        </summary>
        <div>
        <?php echo $panel->panel_content; ?>
        </div>
    </details>
    <?php endforeach; ?>
    </section>
</div>
<?php endif; ?>