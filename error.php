<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_l2b
 *
 * @copyright   Copyright (C) NPEU 2026.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;

#ini_set('display_errors', 0);

if (!isset($this->error)) {
    #$this->error = JError::raiseWarning(404, Text::_('JERROR_ALERTNOAUTHOR'));
    $this->error = new GenericDataException(Text::_('JERROR_ALERTNOAUTHOR'), 404);
    $this->debug = false;
}
#echo "<pre>\n"; var_dump($this->error); echo "</pre>\n"; exit;
$is_error   = true;
$error_code = $this->error->getCode();
#echo '<pre>'; var_dump($is_error); echo '</pre>'; #exit;
$display_errors = preg_match('/^(1|yes|on|true)$/i', ini_get('display_errors'));

$error_code_id = $error_code . '-' . $error_code;
$error_page_title = 'Error ' . $error_code;

if (!$display_errors) {
    $error_code_id = 'error';
    $error_page_title = 'A server error occured';
}

if ($error_code == 404) {
    $error_image_src = 'hero-image-404.jpg';
    $error_hero_message = "Uh oh. We couldn't find that page.";
    $error_page_title = 'Error ' . $error_code;
} else {
    $error_image_src = 'hero-image-error.jpg';
    $error_hero_message = "Oops! Something isn't working";
}
ob_start();
?>
    <div class="l-box  l-box--expand">

        <main id="main" aria-labelledby="<?php echo $error_code_id; ?>">
            <div class="c-hero">
                <p class="c-hero__image"><img src="/images/hero/<?php echo $error_image_src; ?>" alt=""></p>
                <p class="c-hero__heading">
                    <a href="/" class="c-badge  c-badge--primary-logo  l-space-block-end">
                        <svg role="img" focusable="false" aria-labelledby="l2btoolkit--title" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="463.4" height="100" viewBox="0 0 463.4 100">
                            <title id="l2btoolkit--title">Listen2Baby Toolkit</title>
                            <path d="M0 4h3.3v55.1h26.8v3.1H0zM92.5 23.6v3.7c-3.3-2.6-7.2-4.1-11.9-4.1s-10.2 3.1-10.2 7.6 4.3 6.6 11 8.7c6.6 2.2 13.2 4.3 13.2 11.8S89 62.9 80.5 62.9s-9.9-1.6-14.1-5v-4c3.6 3.5 8.6 5.9 14.1 5.9s10.9-3.5 10.9-8.4-4.8-7-11.4-9.3c-6.9-2.2-12.8-4.3-12.8-11.2s5.6-11.2 13.6-11.2 8.6 1.3 11.8 3.6v.2ZM112.7 20.7H125v3.1h-12.4v25.4c0 7.6 4.1 10.4 10 10.4s2.3 0 3.5-.3v3c-.5 0-2.1.3-3.9.3-7.5 0-12.9-4.2-12.9-13.3V23.7h-6.4v-3.1h6.5v-9.7h3.2v9.8zM170.3 42.6h-33c.5 10.7 7.2 17.3 16.6 17.3s10.3-1.9 14.8-6v3.8c-4.3 3.6-9.6 5.4-15 5.4-11.7 0-19.8-8.3-19.8-21.4s9.3-21.6 19.2-21.6 17.2 7 17.2 20.7 0 1.4-.1 2h.1Zm-3.1-3c-.2-11.3-6.8-16.5-13.8-16.5s-15.2 6.3-15.9 16.5h29.8ZM215.8 34.6v27.7h-3.3V35.9c0-8.4-4.3-12.7-11.8-12.7s-12.8 4.8-12.8 12.3v26.7h-3.3V20.7h2.6l.4 7.3c2.3-4.8 7.2-8.1 13.5-8.1s14.7 5.7 14.7 14.7M259 19.5c0-6.6-4.5-13-13.3-13s-11.5 3.1-14.7 6.8V9.2c3.4-3.5 8.8-5.9 14.7-5.9 10.9 0 16.6 7.8 16.6 16.2s-7.1 17.9-26.9 39.5h28.5v3.3h-35.6c26.9-29.1 30.6-34.8 30.6-42.7ZM327 41.5c0-13.3 9.2-21.5 18.9-21.5s13.3 3.7 16.3 11.2l.5-10.4h2.6v41.5h-2.6l-.5-10.4c-3.1 7.5-9.7 11.2-16.2 11.2-9.8 0-19-8.3-19-21.5Zm35.2-.1c0-11.2-7.2-18.3-16-18.3s-16 7-16 18.3 7.4 18.3 16 18.3 15.9-7.1 15.9-18.4h.1ZM385.9 30.9c2.8-7.1 9.6-10.9 16.1-10.9 9.8 0 18.9 8.3 18.9 21.5S411.7 63 402 63s-13.3-3.6-16.3-11.2l-.5 10.4h-2.6V0h3.3zm-.2 10.5c0 11.3 7.4 18.4 16 18.4s16-7.1 16-18.3-7.2-18.3-15.9-18.3-16 7.1-16 18.2zM440.9 79.1h-3.2l7.1-18.4-15.7-39.9h3.6l13.7 35.6 13.5-35.6h3.4l-22.6 58.3h.1ZM296.6 62.2h-16.3V3.8h10.2c9.8 0 16 5.3 16 13.6s-1.6 8.5-4.8 11.3c8.9 1.8 15 8.4 15 17.1s-7.9 16.3-20 16.3h-.1ZM283.5 59h13.1c10.3 0 16.7-5.1 16.7-13.1s-6.9-14.3-16.4-14.3h-4.2v-3.3h.8c6.6 0 9.7-5.5 9.7-10.9S298.4 7 290.5 7h-6.9v51.9h-.1Z"/>
                            <path d="M297.8 41.3c-2.7-6.3-10.4-4.9-10.5 2.5 0 4 3.7 5.6 6.2 7.2 2.4 1.6 4.1 3.7 4.3 4.7.2-.9 2.1-3.1 4.3-4.7 2.4-1.8 6.2-3.1 6.2-7.2 0-7.3-8-8.6-10.5-2.5M58.2 15.8c0-1.3-4.2-2.6-9.5-2.6s-9.5 1.1-9.5 2.6 3.3 2.3 7.8 2.5v8.4c-.3 7.3-1 14.6-2.4 21.8-.9 4.4-2 8.8-4.3 12.8-.2.3-.3.7-.2 1.1h17.6c0-.4 0-.8-.2-1.1-2.4-3.9-3.4-8.3-4.3-12.8-1.4-7.2-2.1-14.5-2.4-21.8-.1-2.4 0-5.8 0-7.2v-1.1c4.3-.2 7.8-1.2 7.8-2.5h-.2Z" opacity=".8"/>
                            <g opacity=".8">
                                <path d="M290.3 79.2H283l.4-2.7h17.4l-.4 2.7h-7.3L290 99.6h-2.9l3.1-20.4ZM326.2 86.5c0 7.2-5.5 13.5-12.8 13.5s-10.2-4.2-10.2-10.5S308.7 76 316 76s10.2 4.2 10.2 10.5m-20.1 2.8c0 4.9 3.2 8 7.4 8s9.7-4.9 9.7-10.5-3.2-8-7.4-8-9.7 5-9.7 10.5M354.8 86.5c0 7.2-5.5 13.5-12.8 13.5s-10.2-4.2-10.2-10.5S337.3 76 344.6 76s10.2 4.2 10.2 10.5m-20 2.8c0 4.9 3.2 8 7.4 8s9.7-4.9 9.7-10.5-3.2-8-7.4-8-9.7 5-9.7 10.5M363.9 76.5h2.9l-3.1 20.4h10l-.4 2.7h-12.9zM387.5 87.7l9.5 11.9h-3.5l-9.2-11.7-1.8 11.7h-2.9l3.5-23.1h2.9l-1.6 10.8 11.9-10.8h3.7l-12.3 11.2ZM406.1 76.5h2.9l-3.5 23.1h-2.9zM422.2 79.2h-7.3l.4-2.7h17.4l-.4 2.7H425l-3.1 20.4H419l3.1-20.4Z"/>
                                <path d="m.3 79.2.4-2.7h279.5l-.4 2.7z" opacity=".8"/>
                            </g>
                        </svg>
                    </a>
                    <br>
                    <span><?php echo $error_hero_message; ?></span>
                </p>
            </div>

            <div class="l-box  l-box--space--block-start--l  elastipad">
                <h1 id="<?php echo $error_code_id; ?>" class="l-box  l-box--space--inline"><?php echo $error_page_title; ?></h1>
            </div>
            <div class="l-box  l-box--space--edge  elastipad">
                <div class="l-box  l-box--space--edge">
                    <?php /*if ($error_code == 404): ?>
                    <p>You could try searching for what you're looking for:</p>

                    <form action="/search" id="searchform" class="" method="GET">
                        <span class="c-composite  u-fill-width">
                            <input type="search" class="c-composite--expand" id="search" placeholder="Search" name="q" value="" aria-label="Search">
                            <button class="search-form__submit" type="submit">
                                <span>Search</span>
                            </button>
                        </span>
                    </form>
                    <?php else:*/ ?>
                    <?php if ($display_errors): ?>
                    <p><?php echo $this->error->getMessage(); ?></p>
                    <p><?php echo str_replace("\n", "<br>\n", $this->error->getTraceAsString()); ?></p>
                    <?php endif; ?>

                    <p>Please email webmaster@npeu.ox.ac.uk</p>
                    <?php /*endif; */?>
                </div>
            </div>

        </main>

    </div>


    <div class="l-box">

    <footer aria-label="Page" data-landmark-index="3">
        <div data-fs-text="center">

            <p class="l-balance  d-border--top--thick">

                <!-- TODO: this should come from a module, probably: -->
                <span class="l-box  l-box--centerX" data-fs-block="inline padding">
                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height"><img src="/images/logos/npeu-logo-lockup.svg" alt="Logo lockup for NPEU, WRH and University of Oxford" height="80" loading="lazy" data-path="local-images:/logos/npeu-logo-lockup.svg"> </a>
                </span>
                <span class="l-box  l-box--centerX" data-fs-block="inline padding">
                    <a href="https://www.phc.ox.ac.uk" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/images/logos/ndpchs-logo.svg" alt="Logo for Nuffield Department of Primary Care Health Sciences - Medical Sciences Division" height="80" loading="lazy" data-path="local-images:/logos/ndpchs-logo.svg"></a>
                </span>
                <span class="l-box  l-box--centerX" data-fs-block="inline padding">
                    <a href="https://www.birmingham.ac.uk" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/images/logos/university-of-birmingham-logo.svg" alt="Logo for University of Birmingham" height="80" loading="lazy" data-path="local-images:/logos/university-of-birmingham-logo.svg"></a>
                </span>
                <span class="l-box  l-box--centerX" data-fs-block="inline padding">
                    <a href="https://www.cardiff.ac.uk" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/images/logos/university-of-cardiff-logo.svg" alt="Logo for Cardiff University | Prifysgol Caerdydd" height="80" loading="lazy" data-path="local-images:/logos/university-of-cardiff-logo.svg"></a>
                </span>
                <span class="l-box  l-box--centerX" data-fs-block="inline padding">
                    <a href="https://www.pointofcarefoundation.org.uk" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/images/logos/point-of-care-foundation-logo.svg" alt="Logo for the Point of Care Foundation" height="80" loading="lazy" data-path="local-images:/logos/point-of-care-foundation-logo.svg"></a>
                </span>
                <span class="l-box  l-box--centerX" data-fs-block="inline padding">
                    <a href="https://www.imperial.nhs.uk" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/images/logos/imperial-college-healthcare-nhs-logo.svg" alt="Logo for NHS - Imperial College Healthcare NHS Trust" height="80" loading="lazy" data-path="local-images:/logos/imperial-college-healthcare-nhs-logo.svg"></a>
                </span>
                <!-- END -->
            </p>

            <div class="l-layout  d-border--top--thick">
                <div class="l-box  l-box--space--edge">
                    <!-- TODO: this should come from a module, probably: -->
                    <div id="mod-custom134" class="mod-custom custom">
                        <p>
                            <img class="float-start" src="/images/logos/nihr-funded-by-logo.svg" alt="Logo for NIHR - National Institute for Health and Care Research" height="80" loading="lazy" data-path="local-images:/logos/nihr-logo.svg">
                        </p>
                        <p>
                            This study is funded by the National Institute for Health and Care Research (NIHR) <a href="https://www.nihr.ac.uk/explore-nihr/funding-programmes/health-and-social-care-delivery-research.htm" rel="noopener">Health and Social Care Delivery Research Programme</a> (<a href="https://fundingawards.nihr.ac.uk/award/NIHR134306" rel="noopener">NIHR134306</a>). The views expressed are those of the author(s) and not necessarily those of the NIHR or the Department of Health and Social Care.
                        </p>
                    </div>
                    <!-- END -->
                </div>
            </div>
        </div>

        <div class="page-footer" data-fs-block="inverted flush" data-fs-text="center">
                <!-- TODO: Should these links be managed by the CMS? -->
                <p role="list" class="c-utilitext   l-layout  l-row  l-row--center  l-gutter--xs  no-print">
                    <span role="listitem" class="l-box">
                        <a href="/"><span>Listen2Baby Toolkit Home</span></a>
                    </span>

                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                    <span role="listitem" class="l-box">
                        <a href="/privacy-cookies"><span>Privacy &amp; Cookies</span></a>
                    </span>

                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                    <span role="listitem" class="l-box">
                        <a href="/accessibility"><span>Accessibility</span></a>
                    </span>

                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                    <span role="listitem" class="l-box">
                        <a href="#top"><span>Top of page</span></a>
                    </span>
                </p>
                <p class="c-utilitext   l-layout  l-row  l-row--center  l-gutter--xs">
                    <span class="l-box">
                        © NPEU 2026
                    </span>
                    <span role="listitem" class="l-box">
                        <a href="https://www.npeu.ox.ac.uk"><span>NPEU website</span></a>
                    </span>
                </p>
                <!-- END -->
            </div>
        </footer>

    </div>
<?php
$error_output = ob_get_contents();
ob_end_clean();

require_once('setup.php');

?>