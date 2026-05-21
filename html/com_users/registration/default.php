<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;


?>
<?php #echo TplL2BHelper::get_messages(); ?>

<form action="<?php echo Route::_('index.php?option=com_users&task=registration.register'); ?>" method="post" enctype="multipart/form-data" class="user-form">
    <fieldset>
        <div class="l-layout l-gutter--s  l-flush-edge-gutter">

            <?php $i = 0; foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
            <?php if ($group == 'params') { continue; } ?>
            <?php $fields = $this->form->getFieldset($group); $hidden = ''; $help = ''; ?>
            <?php if (count($fields)) : ?>

            <div id="fieldset<?php echo $i; ?>" class="l-box">
                <?php /* if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
                <p><?php echo Text::_($fieldset->label); ?></p>
                <?php endif; */ ?>
                <div class="l-layout  l-row  l-row--start  l-gutter--s l-flush-edge-gutter">
                    <?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
                    <?php if ($field->hidden): // If the field is hidden, just display the input. ?>
                    <?php $hidden .= $field->input . "\n"; ?>
                    <?php else: ?>
                    <div class="l-box  ff-width-100--25--30">
                        <?php echo TplL2BHelper::clean_title($field->label); ?>
                    </div>
                    <div class="l-box  ff-width-100--25--70">
                        <?php if ($field->type == 'Password'): ?>
                        <?php echo str_replace('autocomplete="current-password"', 'autocomplete="new-password"', $field->input); ?>
                        <?php else: ?>
                        <?php echo str_replace ('class="', 'class="u-fill-width  ', $field->input); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($field->description) : ?>
                    <div class="l-box  ff-width-100--25--30">
                    </div>
                    <div class="l-box  ff-width-100--25--70">
                        <i><?php echo $field->description; ?></i>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($help)): ?>
                <?php echo $help; ?>
                <?php endif; ?>
                <?php if (!empty($hidden)): ?>
                <?php echo $hidden; ?>
                <?php endif; ?>

            </div>
            <?php endif; ?>
            <?php $i++; endforeach; ?>
            <p class="l-layout  l-row  l-row--start">
                <span class="l-box  ff-width-100--25--30">
                </span>
                <span class="l-box  ff-width-100--25--70" style="margin-block-start: var(--sz-s);">
                    <span style="border-top: 1px solid var(--base-ui-color-lighter); padding-block-start: var(--sz-s)">By submitting this for you are agreeing to abide by our <a href="https://listen2babytoolkit.npeu.ox.ac.uk/terms-of-use"><span>Terms of Use</span></a></span><br>
                    <span>
                        <button type="submit"><span><?php echo Text::_('JREGISTER'); ?></span></button>
                    </span>
                </span>
            </p>
            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="registration.register" />
            <?php echo HTMLHelper::_('form.token'); ?>
        </div>
    </fieldset>
</form>

