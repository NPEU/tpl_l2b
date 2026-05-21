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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;

//load user_profile plugin language
$lang = Factory::getLanguage();
$lang->load( 'plg_user_profile', JPATH_ADMINISTRATOR );


$doc = Factory::getDocument();
$doc->include_avatar_modal = true;


// For now, jQuery is required by CKEditor Footnotes, WYM, and ...
#$jquery = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__)))) . '/js/jquery-3.5.1.min.js';
#$doc->addScript($jquery);



/*
$doc = Factory::getDocument();
#echo '<pre>'; var_dump(get_class_methods($doc)); echo '</pre>';

$doc->addScript('/media/system/js/mootools-core.js');
$doc->addScript('/media/system/js/core.js');
$doc->addScript('/media/system/js/mootools-more.js');
$doc->addScript('/media/system/js/modal.js');

$doc->addStyleSheet('/media/system/css/modal.css');*/






/*
$style = array();
$style[] = '#sbox-overlay[aria-hidden="false"] {';
$style[] = '    background-color: #000000;';
$style[] = '    height: 3337px;';
$style[] = '    left: 0;';
$style[] = '    position: absolute;';
$style[] = '    top: -20px;';
$style[] = '    width: 100%;';
$style[] = '}';
$style[] = '#sbox-window[aria-hidden="false"] {';
$style[] = '    left: 50% !important;';
$style[] = '    margin-left: -350px;';
$style[] = '    position: fixed;';
$style[] = '    top: 50px !important;';
$style[] = '    padding: 0 !important;';
$style[] = '}';

$str = implode("\n", $style);

$doc->addStyleDeclaration($str);
*/

$user        = Factory::getUser();
#echo '<pre>'; var_dump($user); echo '</pre>';
$user_editor = $user->getParam('editor', false);
$j_config    = Factory::getConfig();
#echo '<pre>'; var_dump($j_config); echo '</pre>'; exit;
/*
if ($j_config->get('editor') == 'ckeditorbasic' || $user_editor == 'ckeditorbasic') {
    $script = array();

    $script[] = 'console.log(\'Joomla.editors.instances\', Joomla.editors.instances);';
    $script[] = 'var jeditors = Joomla.editors.instances;';

    $script[] = "jQuery(function() {";
    $script[] = "   jQuery('.profile_save').click(function(e){";
    $script[] = "       jeditors['jform_profile_biography'].update();";
    $script[] = "       jeditors['jform_profile_custom_content'].update();";
    $script[] = "       jeditors['jform_profile_publications_manual'].update();";
    $script[] = "   });";
    $script[] = "});";

    $str = implode("\n", $script);
    ### //$doc->addScriptDeclaration($str);
}
*/
#$script = array();
#$script[] = "jQuery(function() {";
#$script[] = "    window.setTimeout(function(){jQuery('[type=\"password\"]').val('')}, 10)";
#$script[] = "});";
#
#$str = implode("\n", $script);
#$doc->addScriptDeclaration($str);



###$doc->addStyleSheet('/media/jui/css/chosen.css');


$page_head_data = $doc->getHeadData();

$doc->include_script = true;
#$doc->include_joomla_scripts = true;
#echo '<pre>'; var_dump($page_head_data); echo '</pre>'; exit;
#exit;
include(dirname(dirname(dirname(__DIR__))) . '/layouts/partial-slimselect.php');
include(dirname(dirname(dirname(__DIR__))) . '/layouts/partial-a11y-dialog.php');

?>
<?php #echo TplL2BHelper::get_messages(); ?>
<form id="member-profile" action="<?php echo Route::_('index.php?option=com_users&task=profile.save&redirect=user-profile/edit'); ?>" method="post" enctype="multipart/form-data" class="user-form">
    <fieldset>
        <div class="l-layout  l-row  l-gutter  l-flush-edge-gutter">
        <?php  /*<p><strong>Tip:</strong> hover your mouse over each field label to show more information on how to complete that field.</p>*/ ?>
        <?php $i = 0; foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
        <?php #echo '<pre>'; var_dump($fieldset); echo '</pre>'; ?>
        <?php if ($group == 'params') { continue; } ?>
        <?php $fields = $this->form->getFieldset($group); $hidden = ''; $help = ''; ?>
        <?php if (count($fields)) : ?>

            <?php /*if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
            <legend><h2><?php echo Text::_($fieldset->label); ?></h2></legend>
            <p class="u-text-align--right  u-space--below--none">
                <button type="submit" class=""><span><?php echo Text::_('JSAVE'); ?></span></button>
                <span><?php echo Text::_('COM_USERS_OR'); ?>
                    <a class="" href="<?php echo Route::_('/user-profile'); ?>" title="<?php echo Text::_('JCANCEL'); ?>"><?php echo Text::_('JCANCEL'); ?></a>
                </span>
            </p>
            <?php endif; */?>



            <?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
            <?php #echo '<pre>'; var_dump($field->type); echo '</pre>'; ?>

            <?php if ($field->hidden): // If the field is hidden, just display the input. ?>
            <?php $hidden .= $field->input . "\n"; ?>
            <?php else: ?>
            <div class="l-box  ff-width-100--25--25">
                <?php echo TplL2BHelper::clean_title($field->label); ?>
            </div>
            <div class="l-box  ff-width-100--25--75">
                <?php if ($field->type == 'Password'): ?>
                <?php echo str_replace('autocomplete="current-password"', 'autocomplete="new-password"', $field->input); ?>
                <?php else: ?>
                <?php echo $field->input; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>

            <?php endif; ?>
            <?php $i++; endforeach; ?>
            <div class="l-box  ff-width-100--25--25">
            </div>
            <div class="l-box  ff-width-100--25--75">
                <span>
                    <button type="submit"><span><?php echo Text::_('JSAVE'); ?></span></button>
                </span>&emsp;
                <span>
                    <a href="/user-profile/"><span><?php echo Text::_('JCANCEL'); ?></span></a>
                </span>
            </div>
            <?php if (!empty($help)): ?>
            <?php echo $help; ?>
            <?php endif; ?>



            <?php if (!empty($hidden)): ?>
            <?php echo $hidden; ?>
            <?php endif; ?>

            <input type="hidden" name="option" value="com_users" />
            <input type="hidden" name="task" value="profile.save" />
            <input type="hidden" name="redirect" value="/user-profile-edit/" />

            <?php echo HTMLHelper::_('form.token'); ?>
        </div>

    </fieldset>

</form>