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
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;

$session = Factory::getSession();
$registry = $session->get('registry');
$jinput = Factory::getApplication()->input;

$return = $registry->get('users.login.form.data.return', false);
if (!$return) {
    $return = '/user-profile';
} else {
    $return = base64_encode($return);
}
#echo '<pre>'; var_dump($return); echo '</pre>'; exit;
#echo '<pre>'; var_dump($jinput->get('return', '/user-profile')); echo '</pre>'; exit;
$return = $jinput->get('return', $return);

?>
<?php #echo TplL2bHelper::get_messages(); ?>

<?php if(isset($_GET['logged-out'])): ?>
<div>
    <p>You have successfully logged out.</p>
</div>
<?php endif; ?>

<?php if (
    ($this->params->get('logindescription_show') == 1 && $this->params->get('login_description') && trim($this->params->get('login_description')) != '')
  || $this->params->get('login_image') != ''
  ) : ?>
<div>
    <?php if($this->params->get('logindescription_show') == 1) : ?>
    <?php echo $this->params->get('login_description'); ?>
    <?php endif; ?>

    <?php if (($this->params->get('login_image')!='')) :?>
    <img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo Text::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
    <?php endif; ?>
</div>
<?php endif; ?>


<form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="user-form">
    <fieldset>

        <?php foreach ($this->form->getFieldset('credentials') as $field): ?>
        <?php if (!$field->hidden): ?>
        <div class="l-layout  l-row">

            <?php
            #$label = add_classes($field->label, '');
            $label = $field->label;
            #$input = add_classes(preg_replace('#\s?size="\d+"#', '', $field->input), '');
            $input = $field->input;
            if ($session->get('plgSystemFormErrors.password', false)) {
                #$label = add_class($label, 'error');
                #$input = add_class($input, 'error');
            }
            ?>
            <div class="l-box  ff-width-100--30--20">
            <?php echo $label; ?>
            </div>
            <div class="l-box  ff-width-100--30--80">
            <?php echo str_replace('class="', 'class="u-fill-width  ', $input); ?>
            </div>

        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
        <div class="l-layout  l-row  l-row--start">
            <div class="l-box  ff-width-100--30--20">
            </div>
            <div class="l-box  ff-width-100--30--80">
                <input id="remember" type="checkbox" name="remember" value="yes" />
                <label id="remember-lbl" for="remember"><?php echo Text::_('JGLOBAL_REMEMBER_ME') ?></label>
            </div>
        </div>
        <?php endif; ?>
        <div class="l-layout  l-row  l-row--start">
            <div class="l-box  ff-width-100--30--20">
            </div>
            <div class="l-box  ff-width-100--30--80">
                <button type="submit"><?php echo Text::_('JLOGIN'); ?></button>&emsp;
                <a href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>"><?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?></a>&emsp;
                <a href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>"><?php echo Text::_('COM_USERS_LOGIN_RESET'); ?></a>
                <input type="hidden" name="return" value="<?php echo $return; ?>" />
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>

        </div>

    </fieldset>

</form>


