<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;

use NPEU\Plugin\System\Blocks\Helper\BlocksHelper;

$app = Factory::getApplication();

/** @var \Joomla\Component\Content\Site\View\Category\HtmlView $this */
$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

?>
<div class="l-box  l-box--space--edge">
    <div class="c-discussion-board">
        <?php echo $afterDisplayTitle; ?>

        <?php if ($this->category->getParams()->get('access-create')) : ?>
        <p>
            <?php #echo HTMLHelper::_('contenticon.create', $this->category, $this->category->params); ?>
            <a href="/component/content?task=article.add&amp;return=aHR0cHM6Ly9sMmJkZXYubnBldS5veC5hYy51ay9kaXNjdXNzaW9uLWJvYXJk&amp;a_id=0&amp;catid=8" data-fs-block="inline border padding" class="c-cta  c-cta--inline  c-cta--small"><span><?php echo BlocksHelper::renderUse('plus'); ?></span><span class="u-separator">&nbsp;</span><span>New post</span></a>
        </p>
        <?php endif; ?>

        <?php /*if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
            <div class="category-desc clearfix">
                <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
                    <?php echo LayoutHelper::render(
                        'joomla.html.image',
                        [
                            'src' => $this->category->getParams()->get('image'),
                            'alt' => empty($this->category->getParams()->get('image_alt')) && empty($this->category->getParams()->get('image_alt_empty')) ? false : $this->category->getParams()->get('image_alt'),
                        ]
                    ); ?>
                <?php endif; ?>
                <?php echo $beforeDisplayContent; ?>
                <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                    <?php echo HTMLHelper::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
                <?php endif; ?>
                <?php echo $afterDisplayContent; ?>
            </div>
        <?php endif;*/ ?>

        <?php /*if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
            <?php if ($this->params->get('show_no_articles', 1)) : ?>
                <div class="alert alert-info">
                    <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                        <?php echo Text::_('COM_CONTENT_NO_ARTICLES'); ?>
                </div>
            <?php endif; ?>
        <?php endif;*/ ?>

        <?php /*if (!empty($this->lead_items)) : ?>
            <div class="com-content-category-blog__items blog-items items-leading <?php echo $this->params->get('blog_class_leading'); ?>">
                <?php foreach ($this->lead_items as &$item) : ?>
                    <div class="com-content-category-blog__item blog-item">
                        <?php
                        $this->item = &$item;
                        echo $this->loadTemplate('item');
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif;*/ ?>

        <?php if (!empty($this->intro_items)) : ?>
            <?php /*$blogClass = $this->params->get('blog_class', ''); ?>
            <?php if ((int) $this->params->get('num_columns') > 1) : ?>
                <?php $blogClass .= (int) $this->params->get('multi_column_order', 0) === 0 ? ' masonry-' : ' columns-'; ?>
                <?php $blogClass .= (int) $this->params->get('num_columns'); ?>
            <?php endif; */?>
            <div class="c-discussion-board__post-list">
                <div class="l-layout  l-gutter  l-flush-inline-gutter">
                <?php foreach ($this->intro_items as $key => &$item) : ?>
                    <?php
                    $this->item = & $item;
                    echo $this->loadTemplate('item');
                    ?>
                <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php /*if (!empty($this->link_items)) : ?>
            <div class="items-more">
                <?php echo $this->loadTemplate('links'); ?>
            </div>
        <?php endif; */?>

        <?php /*if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
            <div class="com-content-category-blog__children cat-children">
                <?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
                    <h3> <?php echo Text::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
                <?php endif; ?>
                <?php echo $this->loadTemplate('children'); ?> </div>
        <?php endif;*/ ?>
        <?php // Code to add a link to submit an article. ?>
        <?php /*if ($this->category->getParams()->get('access-create')) : ?>
        <p>
            <a href="/component/content?task=article.add&amp;return=aHR0cHM6Ly9sMmJkZXYubnBldS5veC5hYy51ay9kaXNjdXNzaW9uLWJvYXJk&amp;a_id=0&amp;catid=8" data-fs-block="inline border padding" class="c-cta  c-cta--inline  c-cta--small"><span><svg width="1.25em" height="1.25em" aria-hidden="true" focusable="false" display="inline"><use href="#blocksicon-plus"></use></svg></span><span class="u-separator">&nbsp;</span><span>New post</span></a>
        </p>
        <?php endif;*/ ?>

        <?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
        <div class="com-content-category-blog__navigation w-100">
            <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                <p class="com-content-category-blog__counter counter float-md-end pt-3 pe-2">
                    <?php echo $this->pagination->getPagesCounter(); ?>
                </p>
            <?php endif; ?>
            <div class="com-content-category-blog__pagination">
                <?php echo $this->pagination->getPagesLinks(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
