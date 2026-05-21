<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Component\Content\Site\View\Form\HtmlView $this */
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
/*$wa = $this->getDocument()->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate')
    ->useScript('com_content.form-edit');

$this->tab_name = 'com-content-form';*/
$this->ignore_fieldsets = ['image-intro', 'image-full', 'jmetadata', 'item_associations'];
#$this->useCoreUI = true;

// Create shortcut to parameters.
$params = $this->state->get('params');

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings
if (!$params->exists('show_publishing_options')) {
    $params->set('show_urls_images_frontend', '0');
}

$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__))));

$doc = Factory::getDocument();
$doc->addScript($template_path . '/js/quill.js');
/*$doc->addScriptDeclaration("


");
*/
$doc->addStyleSheet($template_path . '/css/quill.css');

/*
$id = 0;

if (isset($this->item) && !empty($this->item->id))
{
    $id = (int) $this->item->id;
}
else
{
    $app = Factory::getApplication();
    $id  = $app->input->getInt('id', 0);
}*/
$articleId = !empty($this->item->id) ? (int) $this->item->id : 0;
$a_id = !empty($articleId) ? '&amp;a_id=' . $articleId : '';
$menu_segment = empty($articleId) ? '/create-a-post?' . $articleId : '?';
#$articleAlias = !empty($this->item->alias) ? $this->item->alias : '';
#/discussion-board/create-a-post?view=form&amp;layout=edit&amp;catid=8&amp;return=aHR0cHM6Ly9sMmJkZXYubnBldS5veC5hYy51ay9kaXNjdXNzaW9uLWJvYXJk
?>
<form action="/discussion-board<?php echo $menu_segment; ?>view=form&amp;layout=edit<?php echo $a_id; ?>&amp;catid=8&amp;return=aHR0cHM6Ly9sMmJkZXYubnBldS5veC5hYy51ay9kaXNjdXNzaW9uLWJvYXJk" method="post" name="adminForm" id="adminForm" class="user-form">
    <fieldset>
        <?php echo $this->form->renderField('title'); ?>

        <?php #echo $this->form->renderField('articletext'); ?>
        <div class="control-group">
            <div class="control-label"><label id="jform_articletext-lbl" for="jform_articletext" class="required">
                Message<span class="star" aria-hidden="true">&nbsp;*</span></label>
            </div>
            <div class="controls">
             <textarea
                hidden
                name="jform[articletext]"
                id="jform_articletext"
                cols="30"
                rows="10"
                style="width: 100%; height: 500px;"
                required
            ><?php echo htmlspecialchars($this->item->articletext, ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div id="jform_articletext_quill" style="height: 500px;"></div>
            </div>
        </div>


        <?php echo LayoutHelper::render('joomla.edit.params', $this); ?>


        <?php echo str_replace('<input type="hidden" name="task" value="" >', '', $this->form->renderControlFields()); ?>

        <input type="hidden" name="jform[catid]" value="8">
        <input type="hidden" name="task" value="article.save" />
        <input type="hidden" name="jform[state]" value="1">
        <?php /*<input type="hidden" name="a_id" value="<?php echo $articleId; ?>">
        <input type="hidden" name="jform[id]" id="jform_id" value="<?php echo $articleId; ?>">
        <input type="hidden" name="jform[alias]" id="jform_alias" value="<?php echo htmlspecialchars($articleAlias, ENT_QUOTES, 'UTF-8'); ?>">*/ ?>

        <p>
            <?php /*<button type="button" class="btn btn-primary" data-submit-task="article.apply">
                <span class="icon-check" aria-hidden="true"></span>
                <?php echo Text::_('JSAVE'); ?>
            </button>
            <button type="button" class="btn btn-primary" data-submit-task="article.save">
                <span class="icon-check" aria-hidden="true"></span>
                <?php echo Text::_('JSAVEANDCLOSE'); ?>
            </button>
            <button type="button" class="btn btn-danger" data-submit-task="article.cancel">
                <span class="icon-times" aria-hidden="true"></span>
                <?php echo Text::_('JCANCEL'); ?>
            </button>
            */ ?>
            <button type="submit" data-submit-task="article.save">
                <?php echo Text::_('JSUBMIT'); ?>
            </button>&emsp;
            <a href="/discussion-board"><?php echo Text::_('JCANCEL'); ?></a>
        </p>
    </fieldset>

</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('jform_articletext');
        const editorEl = document.getElementById('jform_articletext_quill');

        const quill = new Quill(editorEl, {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        function syncToTextarea() {
            const html = quill.root.innerHTML;
            textarea.value = (html === '<p><br></p>') ? '' : html;
        }

        if (textarea.value.trim()) {
            quill.clipboard.dangerouslyPasteHTML(textarea.value);
        }

        syncToTextarea();

        quill.on('text-change', syncToTextarea);

        const form = textarea.form;

        if (form) {
            form.addEventListener('submit', syncToTextarea);
        }
    });
</script>