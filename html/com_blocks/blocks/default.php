<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_blocks
 *
 * @copyright   Copyright (C) NPEU 2025.
 * @license     MIT License; see LICENSE.md
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

use NPEU\Plugin\System\Blocks\Helper\BlocksHelper;

$app    = Factory::getApplication();
$params = $app->getParams();
$title = $params->get('page_title');

function module_data($row, $n) {
    $data = [];
    $data[] = 'data_module_id="' . $row['block_' . $n . '_id'] . '"';

    return implode(' ', $data);
}

function row_classes($row) {

    if (!empty($row['row_classes'])) {
        return '  ' . $row['row_classes'];
    }
    return '';
}

function block_classes($row, $n) {
    $k = 'block_' . $n . '_classes';
    if (!empty($row[$k])) {
        return '  ' . $row[$k];
    }
    return '';
}

#echo BlocksHelper::(); // prints sprite (cached)
?>
<?php /*if ($this->params->get('show_page_heading')) : ?>
<h1><?php echo $this->escape($title); ?></h1>
<?php endif; */ ?>
<?php if (!empty($this->rows)): ?>
<div class="l-layout--blocks-grid  com-blocks">
<?php $i = 0; foreach ($this->rows as $row): $i++?>
    <?php if (!empty($row['separator'])) : ?>
        <hr>
    <?php endif; ?>

    <div  class="l-layout--blocks-grid__row  l-layout--blocks-grid__row--<?php echo $row['columns']; ?>  l-layout--blocks-grid__row-<?php echo $i; ?><?php echo row_classes($row); ?>">

        <?php if (!empty($row['row_title'])) : ?>
        <div class="l-layout--blocks-grid__block  l-layout--blocks-grid__block--span-all">
            <h2><?php echo $row['row_title'] ?></h2>
        </div>
        <?php endif; ?>

        <?php if (!empty($row['block_1_id'])) : ?>
        <div class="l-layout--blocks-grid__block  l-layout--blocks-grid__block-1<?php echo block_classes($row, 1); ?>" <?php echo module_data($row, 1); ?>>
            <?php echo HTMLHelper::_('content.prepare', '{loadmoduleid ' . $row['block_1_id'] . '}'); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($row['block_2_id'])) : ?>
        <div class="l-layout--blocks-grid__block  l-layout--blocks-grid__block-2<?php echo block_classes($row, 2); ?>" <?php echo module_data($row, 2); ?>>
            <?php echo HTMLHelper::_('content.prepare', '{loadmoduleid ' . $row['block_2_id'] . '}'); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($row['block_3_id'])) : ?>
        <div class="l-layout--blocks-grid__block  l-layout--blocks-grid__block-3<?php echo block_classes($row, 3); ?>" <?php echo module_data($row, 3); ?>>
            <?php echo HTMLHelper::_('content.prepare', '{loadmoduleid ' . $row['block_3_id'] . '}'); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($row['block_4_id'])) : ?>
        <div class="l-layout--blocks-grid__block  l-layout--blocks-grid__block-4<?php echo block_classes($row, 4); ?>" <?php echo module_data($row, 4); ?>>
            <?php echo HTMLHelper::_('content.prepare', '{loadmoduleid ' . $row['block_4_id'] . '}'); ?>
        </div>
        <?php endif; ?>

    </div>

<?php endforeach; ?>
</div>
<?php endif; ?>