<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Component\Finder\Site\View\Search\HtmlView $this */
/*
* This segment of code sets up the autocompleter.
*/
if ($this->params->get('show_autosuggest', 1)) {
    $this->getDocument()->getWebAssetManager()->usePreset('awesomplete');
    $this->getDocument()->addScriptOptions('finder-search', ['url' => Route::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component', false)]);

    Text::script('COM_FINDER_SEARCH_FORM_LIST_LABEL');
    Text::script('JLIB_JS_AJAX_ERROR_OTHER');
    Text::script('JLIB_JS_AJAX_ERROR_PARSE');
}

?>

<form action="<?php echo Route::_($this->query->toUri()); ?>" method="get" class="user-form  c-form">
    <?php echo $this->getFields(); ?>
    <fieldset>
        <div class="l-layout  l-row  l-row--start  l-gutter--s l-flush-edge-gutter">
            <div class="l-box  ff-width-100--25--30">
                <label for="q">
                    <?php echo Text::_('COM_FINDER_SEARCH_TERMS'); ?>
                </label>
            </div>
            <div class="l-box  ff-width-100--25--70">
                <span class="c-form__composite  c-form__composite--fill">
                    <input type="text" name="q" id="q" class="c-form__composite__expand" value="<?php echo $this->escape($this->query->input); ?>">
                    <button type="submit" class="">
                        <?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
                    </button>
                </span>
            </div>
        </div>
    </fieldset>

    <?php if ($this->params->get('show_advanced', 1)) : ?>
        <fieldset id="advancedSearch" class="com-finder__advanced js-finder-advanced collapse<?php if ($this->params->get('expand_advanced', 0)) {
            echo ' show';
                                                                                             } ?>">
            <legend class="com-finder__search-advanced visually-hidden">
                <?php echo Text::_('COM_FINDER_SEARCH_ADVANCED_LEGEND'); ?>
            </legend>
            <?php if ($this->params->get('show_advanced_tips', 1)) : ?>
                <div class="com-finder__tips card card-outline-secondary mb-3">
                    <div class="card-body">
                        <?php echo Text::_('COM_FINDER_ADVANCED_TIPS_INTRO'); ?>
                        <?php echo Text::_('COM_FINDER_ADVANCED_TIPS_AND'); ?>
                        <?php echo Text::_('COM_FINDER_ADVANCED_TIPS_NOT'); ?>
                        <?php echo Text::_('COM_FINDER_ADVANCED_TIPS_OR'); ?>
                        <?php if ($this->params->get('tuplecount', 1) > 1) : ?>
                            <?php echo Text::_('COM_FINDER_ADVANCED_TIPS_PHRASE'); ?>
                        <?php endif; ?>
                        <?php echo Text::_('COM_FINDER_ADVANCED_TIPS_OUTRO'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div id="finder-filter-window" class="com-finder__filter">
                <?php echo HTMLHelper::_('filter.select', $this->query, $this->params); ?>
            </div>
        </fieldset>
    <?php endif; ?>
</form>
