<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;

?>
<?php #echo TplL2BHelper::get_messages(); ?>


<form action="<?php echo Route::_('index.php?option=com_users&task=reset.request'); ?>" method="post" class="user-form">
    <fieldset>

        <?php $i = 0; foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
        <?php if ($group == 'params') { continue; } ?>
        <?php $fields = $this->form->getFieldset($group); $hidden = ''; $help = ''; ?>
        <?php if (count($fields)) : ?>

        <div id="fieldset<?php echo $i; ?>">
            <?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
            <p><?php echo Text::_($fieldset->label); ?></p>
            <?php endif; ?>
            <div class="l-layout  l-row  l-row--start">

                <?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
                <?php #echo '<pre>'; var_dump($field->type); echo '</pre>'; ?>
                <?php if ($field->type == 'EditHelp'): ?>
                <div class="u-fill-width">
                    <?php $help .= $field->input . "\n"; ?>
                </div>
                <?php elseif ($field->type == 'EditMsg'): //editmsg ?>
                <div hidden aria-hidden="false">Notice</div>
                <p class="u-text-align--center  c-system-message  u-fill-width"><?php echo TplL2BHelper::clean_title($field->label); ?></p>
                <?php elseif ($field->hidden): // If the field is hidden, just display the input. ?>
                <?php $hidden .= $field->input . "\n"; ?>
                <?php else: ?>
                <div class="l-box  l-box--space--inline-end  <?php echo $field->type == 'Editor' ? 'u-fill-width' : 'ff-width-100--25--30'?>">
                    <?php if ($field->type == 'Gravatar' || $field->type == 'ImageEdit'): ?>
                    <?php echo preg_replace('/\sfor="[^"]+"/', '', TplL2BHelper::clean_title($field->label)); ?>
                    <?php else: ?>
                    <?php echo TplL2BHelper::clean_title($field->label); ?>
                    <?php endif; ?>
                </div>
                <div class="l-box  <?php echo $field->type == 'Editor' ? 'u-fill-width' : 'ff-width-100--25--70'?>">
                    <?php if ($field->type == 'Editor' && $field->required): ?>
                    <?php echo preg_replace('/<textarea/', '<textarea class="required" required aria-required="true"', $field->input); ?>
                    <?php elseif ($field->type == 'ImageEdit'): ?>
                    <div>
                        <?php echo $field->input; ?>
                    </div>
                    <?php elseif ($field->type == 'Password'): ?>
                    <?php #echo add_class(str_replace('autocomplete="off"', 'autocomplete="new-password"', $field->input), 'text-input'); ?>
                    <?php echo str_replace('autocomplete="off"', 'autocomplete="new-password"', $field->input); ?>
                    <?php else: ?>
                    <?php #echo in_array($field->type, array('Email', 'Text')) ? add_class($field->input, 'text-input') : $field->input; ?>
                    <?php echo str_replace ('class="', 'class="u-fill-width  ', $field->input); ?>
                    <?php endif; ?>
                </div>
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
        <div class="l-layout  l-row  l-row--start">
            <div class="l-box  l-box--space--inline-end  ff-width-100--25--30">
            </div>
            <div class="l-box  ff-width-100--25--70">
                <span>
                    <button type="submit"><span>Send verification code</span></button>
                </span>
            </div>
        </div>
        <?php echo HTMLHelper::_('form.token'); ?>
    </fieldset>
</form>
