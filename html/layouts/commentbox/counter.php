<?php
/**
 * @author      Lefteris Kavadas
 * @copyright   Copyright (c) 2016 - 2026 Lefteris Kavadas / firecoders.com
 * @license     GNU General Public License version 3 or later
 */


\defined('_JEXEC') or die;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;

$page_is_subroute = TplL2BHelper::is_page_subroute();
extract($displayData);
?>
<?php if (!$page_is_subroute) : ?>
<div>
    <a href="<?php echo $url; ?>#comments" class="commentbox-counter">
        <span></span>
    </a>
</div>
<?php endif; ?>