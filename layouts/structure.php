<?php
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

use NPEU\Template\L2b\Site\Helper\L2BHelper as TplL2BHelper;
use NPEU\Plugin\System\Blocks\Helper\BlocksHelper;

$block_css_files = false;
#$block_css_files = true;
$pageclass = empty($pageclass) ? '' : '  ' . $pageclass;
?><!doctype html>
<html lang="en-gb" class="env-<?php echo $env . $pageclass; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <?php if($page_keywords): ?>
    <meta name="keywords" content="<?php echo $page_keywords; ?>" />
    <?php endif; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">


    <!-- Ultra-light fallback styles for ancient browsers: -->
    <meta id="css_has_loaded">
    <style>
        /*
            Tiny Fall-Back Styles (https://github.com/Fall-Back/Patterns/edit/master/Page/README.md)

            The following styles provide a better visual experience in cases where linked
            stylesheets aren't loaded for any reason. It's recommended that any styles that won't
            be used by the elements on the page be removed to make this as lean as possible, and
            the run through a minifier (e.g. https://cssminifier.com) to compress it as much a
            possible, since this is sent on each request and not cached.
            Note there's a section that uses attributes to apply styles to specific elements. This
            is so as not to pollute the class space and help authors make distinctions.
            There's a much long essay on this brewing and I'll add the link when it's done.

            Colour references for ease of search/replace:
            https://www.color-hex.com/color-palette/103353
            colour-1: #d0ba98   (208,186,152)
            colour-2: #d8caa9   (216,202,169)
            colour-3: #5d4777   (141,128,121)
            colour-4: #b8b6b0   (184,182,176)
            colour-5: #aeb2a6   (174,178,166)

        /* --| Core styles |--------------------------------------------------------------------- */
        html {
            background: #5d4777;
        }

        body {
            font: 1em/1.4 sans-serif;
            padding: 2em;
            margin: 0 auto;
            max-width: 50em;
            background: #fff;
        }

        /* For older browsers:(see https://github.com/aFarkas/html5shiv) */
        article,
        aside,
        dialog,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block;
        }

        summary {
            cursor: pointer;
        }

        @supports (list-style-type: disclosure-closed) {
            summary {
                display: list-item;
            }
        }

        summary > * {
            display: inline;
        }

        mark {
            background: #FF0;
            color: #000;
        }

        template,
        [hidden] {
            display: none;
        }

        /* The "older browser" message makes use of a fieldset to add a border no matter what: */
        fieldset {
            border: 1px solid;
            border-color: currentColor;
            margin: 1em 0;
            padding: 1em;
        }

        /* More responsive images: */
        /* Note ancient image tag is actually for the SVG FalBack PNG method */
        img,
        image,
        object,
        svg {
            max-width: 100%;
            -ms-interpolation-mode: bicubic;
            vertical-align: middle;
            height: auto;
            border: 0;
        }

        img[height="80"] {
            height: 80px;
            width: auto;
        }

        /* Links and image links */
        /*@supports not (color: oklch(from red l c h)) {*/
        * {
            color: inherit;
        }


        a[href]:hover {
            text-decoration: none;
        }

        /*a[href] img {
            padding: 0.3em;
            margin: 0.2em;
        }*/

        /*
            Putting things like tables in figures makes sense and allows them to become scrollable
            if they're too wide.
        */
        figure {
            max-width: 100%;
            overflow-x: auto;
        }

        /*
            BUT! Opera Mini doesn't support scrolling areas so hacking it out for that browser:
        */
        _:-o-prefocus, :root figure {
            max-width: initial;
            overflow-x: visible;
        }

        hr {
            border-style: solid;
            border-width: 0 0 1px 0;
            margin: 1em 0;
            color: currentColor;
        }

        pre {
            width: 100%;
            overflow-x: scroll;
            overflow-y: auto;
        }

        video {
            max-width: 100%;
            height: auto;
        }


        /* --| Form styles |--------------------------------------------------------------------- */
        /* If you're using forms, keep this: */

        button {
            background-color: #b8b6b0;
        }

        button:focus {
            outline: 1px solid currentColor;
        }

        button,
        input,
        label,
        select,
        textarea {
            vertical-align: middle;
            min-height: 2.2em;
            margin: 0.2em 0;
        }

        button,
        input[type="checkbox"],
        input[type="radio"],
        label,
        select {
            cursor: pointer;
        }

        button,
        input,
        textarea {
            padding: 0 0.5em;
            line-height: 1.5;
        }

        textarea {
            width: 100%;
        }


        /* --| Table styles |-------------------------------------------------------------------- */
        /* If you're using tables, keep this: */

        table {
            width: 100%;
            border: 1px solid currentColor;
            border-collapse: collapse;
        }

        table[role="presentation"] {
            border: 0;
            table-layout: fixed;
        }

        table[role="presentation"] td {
            border: 0;
        }

        th {
            background-color: #b8b6b0;
        }

        caption, td, th {
            padding: 0.5em;
        }

        caption {
            max-width: 44em;
        }

        /*
            What follows is a mix of markup patterns and attributes to help provide a more
            reasonable fallback - it's unconventional, so leave it out if you like.
        */

        /* Attributes to replicate deprecated HTML styling: */

        /* Would have been align="right": */
        [data-fs-text~="right"] {
            text-align: right;
        }

        /* Would have been align="center": */
        [data-fs-text~="center"] {
            text-align: center;
        }

        /* Would have been the 'big' element: */
        [data-fs-text~="larger"] {
            font-size: larger;
        }

        [data-fs-text~="nowrap"] {
            white-space: nowrap;
        }
    </style>

    <!-- From here we're cutting off IE9- to stop all kinds of JS and CSS fails. -->
    <!--[if !IE]><!-->

    <style>
        /*
            Tiny Fall-Back Styles continued ...

            What follows is a mix of markup patterns and attributes to help provide a more
            reasonable fallback - it's unconventional, so leave it out if you like.
        */

        [data-fs-layout~="stack"] > * {
            margin-top: 0;
            margin-bottom: 0;

        }

        [data-fs-layout~="stack"] > * + * {
            margin-top: 1.4rem;
        }

        /* --| Block styles |-------------------------------------------------------------------- */
        [data-fs-block] {
            display: block;
            margin-left: 0;
            margin-right: 0;
        }

        [data-fs-block~="inline"] {
            display: inline-block;
        }

        [data-fs-block~="background"] {
            background: #b8b6b0;
            padding: 1em;
        }

        [data-fs-block~="inverted"]  {
            background-color: #5d4777;
            padding: 1em;
        }

        [data-fs-block~="inverted"] * {
            color: #fff;
        }


        [data-fs-block~="inverted"] img {
            background: #fff;
            padding: 0.5em;
            border: 0;
        }

        [data-fs-block~="border"] {
            border: 1px solid #5d4777;
            padding: 1em;
        }

        [data-fs-block~="rounded"] {
            border-radius: 1em;
        }

        [data-fs-block~="padding"] {
            padding: 1em;
        }

        [data-fs-block~=flush]{
            margin-left: -2em;
            margin-right: -2em;
        }

        [data-fs-block~=flush]:last-child{
            margin-bottom: -2em;
        }

        /* --| Table Layout |-------------------------------------------------------------------- */
        /*
            Useful when you have a very small amount of items you want to display side-by-side.
            Like, maybe 2, on the left and right. It doesn't wrap so the items should be small.
            There's reasonable support. Better support would be:
            `<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">`
            But we're not supposed to use deprecated 'presentational' elements and attributes.
        */
        [data-fs-block~="table"] {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        [data-fs-block~="table--spaced"] {
            border-spacing: 1em;
        }

        [data-fs-block~="table"] > * {
            display: table-cell;
            padding: 0.5em;
        }


        /* --| Flex Layout |--------------------------------------------------------------------- */
        /*
            More responsive and has wrapping, but less well supported than the table layout.
        */
        [data-fs-block~="flex"] {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        [data-fs-block~="flex"] > * {
            -webkit-box-flex: 1;
            -webkit-flex: 1 1 auto;
            -moz-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto
        }

        /* --| Other stuff |--------------------------------------------------------------------- */

        /* Responsive embeds (e.g. YouTube, maps) via http://embedresponsively.com. */
        [data-fs-block="video"] {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }

        [data-fs-block="video"] iframe,
        [data-fs-block="video"] object,
        [data-fs-block="video"] embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }


        /* Horizontal rules: */
        [data-fs-hr="larger"] {
            border-top-width: 10px;
        }

        /* Visually hidden / SR only: */
        [data-fs-hidden="visually"],
        [data-fs-hidden="visually-revealable"]:not(:focus):not(:active) {
            border: 0 !important;
            clip: rect(1px, 1px, 1px, 1px) !important;
            -webkit-clip-path: inset(50%) !important;
                    clip-path: inset(50%) !important;
            height: 1px !important;
            overflow: hidden !important;
            padding: 0 !important;
            position: absolute !important;
            width: 1px !important;
            white-space: nowrap !important;
        }
    </style>

    <?php if (!$block_css_files) : ?>
    <!--
        Accessible font loading. FOUT is a lesser evil than FOIT.
        (https://keithclark.co.uk/articles/loading-css-without-blocking-render/)
    -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

    <!--
        Print (Edge doesn't apply to print otherwise)
        Edge 79+, Chrome 74+, Firefox 63+, Opera 64+, Safari 10.1+, iOS 10.3+, Android 81+
    -->
    <?php /*<link rel="stylesheet" href="<?php echo TplL2BHelper::stamp_filename('/templates/l2b/css/style.min.css'); ?>" media=" */ ?>
    <link rel="stylesheet" href="<?php echo TplL2BHelper::stamp_filename('/templates/l2b/css/style.css'); ?>" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">

    <?php foreach($page_stylesheets as $stylesheet => $options): ?>
    <!--
        Print, Edge 12? - 18
        Edge 79+, Chrome 58+, Opera 45+, Safari 10+, iOS 10+, Android Webview/Chrome 58+, Samsung Internet
        FF 47+
    -->
    <link rel="stylesheet" href="<?php echo TplL2BHelper::stamp_filename($stylesheet); ?>" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">
    <?php endforeach; ?>

    <?php if (!empty($doc->joomla_stylesheets)): ?>
    <?php foreach($doc->joomla_stylesheets as $stylesheet => $options): ?>
    <!--
        Print, Edge 12? - 18
        Edge 79+, Chrome 58+, Opera 45+, Safari 10+, iOS 10+, Android Webview/Chrome 58+, Samsung Internet
        FF 47+
    -->
    <link rel="stylesheet" href="<?php echo TplL2BHelper::stamp_filename($stylesheet); ?>" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">
    <?php endforeach; ?>
    <?php endif; ?>

    <?php endif; ?>

    <!-- Template scripts -->
    <?php  /*<script src="<?php echo TplL2BHelper::stamp_filename('/templates/l2b/js/script.min.js'); ?>"></script> */ ?>
    <script src="<?php echo TplL2BHelper::stamp_filename('/templates/l2b/js/script.js'); ?>"></script>

    <?php if (!empty($doc->include_joomla_scripts) && !empty($doc->joomla_scripts)): ?>
    <!-- CMS scripts -->
    <?php foreach($doc->joomla_scripts as $script => $options): ?>
    <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
    <?php endif; ?>

    <!-- Other scripts -->
    <?php foreach($page_scripts as $script => $options): ?>
    <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>

    <?php if (!empty($page_style)): ?>
    <style>
    <?php foreach($page_style as $style): ?>
    <?php echo $style . "\n\n"; ?>
    <?php endforeach; ?>
    </style>
    <?php endif; ?>

    <?php if ($env != 'production') : ?>
    <style>

    #env_container {
        position: sticky;
        top: 0;
        z-index: 99999;
        background: #cc6289;
        color: #fff;
        box-shadow: 0 0 2px 2px rgba(0,0,0,0.3);
    }

    /*.env-testing .env_container,
    .env-sandbox .env_container,
    .env-next .env_container {
        background: #ffc77c;
        color: #222;
    }*/




    #env_container * {
        margin: 0;
        padding: 0;
        border: 0;
    }


    #env_container > div {
        position: relative;
        padding: 1.2rem 0.6rem;
        text-align: center;
    }

    #env_container p {
        margin: 0;
    }


    #env_container button {
        position: absolute;
        right: 1.2rem;
        top: 1rem;
        background-color: rgba(0,0,0,0.1);
        padding: 0 0.6rem;
        color: inherit;
    }

    #env_container button:hover,
    #env_container button:active,
    #env_container button:focus {
        background-color: rgba(0,0,0,0.3);
    }
    </style>

    <?php endif; ?>

    <!--<![endif]-->

<?php /*
    <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon.svg" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="L2B Toolkit Styleguide" />
    <link rel="manifest" href="site.webmanifest" />
*/ ?>
    <?php #if ($env == 'production') : ?>

    <?php echo '<!-- ' . (($isGuest) ? 'Is' : 'Not') . ' guest -->'; ?>

    <?php echo '<!-- ' . (($isMember) ? 'Is a' : 'Not a') . ' member -->'; ?>

    <?php // Only track Guests + Members
    if ($isGuest || $isMember): ?>

    <script>
        <?php if ($isMember && $user->id): ?>
        document.isMember = true;
        <?php else: ?>
        document.isMember = false;
        <?php endif; ?>

        var _paq = window._paq = window._paq || [];

        <?php if ($isMember && $user->id): ?>
            <?php
                // Get Organisation custom field (ID = 3)
                $organisation = '';
                $fields = FieldsHelper::getFields('com_users.user', $user, true);

                foreach ($fields as $field) {
                    if ((int)$field->id === 3) {
                        $organisation = (string) ($field->rawvalue ?: $field->value);
                        break;
                    }
                }

                $jsUserId = (int) $user->id;
                $jsOrg = htmlspecialchars($organisation, ENT_QUOTES, 'UTF-8');
            ?>

            _paq.push(['setUserId', '<?= $jsUserId ?>']);
            _paq.push(['setCustomDimension', 1, '<?= $jsOrg ?>']);
        <?php endif; ?>

        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);

        (function() {
            var u="//<?php echo $_SERVER['SERVER_NAME']; ?>/stats/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '1']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <?php endif; ?>

    <?php #$piwik_url = '?url=' . base64_encode($_SERVER['REQUEST_URI']) . '&title=' . base64_encode($page_title); ?>

    <!-- End Matamo Code -->
    <?php #endif; ?>

    <!-- Social Media -->
    <?php /*if (!empty($x)): ?>
    <?php foreach ($x as $name => $value): ?>

    <meta name="x:<?php echo $name; ?>" content="<?php echo $value; ?>">
    <?php endforeach; ?>
    <?php endif; */?>

    <!-- End Social Media -->

</head>
<body  id="top" role="document" class="" data-layout="default"><?php /*<body role="document" class="{{ project_data.theme_class }}" data-layout="{{ page.layout_name }}"> */ ?>

    <?php /*if ($env == 'production') : ?>
    <!-- Matamo no-js tracking: -->
    <noscript>
        <img src="/templates/l2b/endpoints/matamo-no-js.php<?php echo $piwik_url; ?>" style="display:none;" alt="" />
    </noscript>
    <!-- Matamo print tracking: -->
    <style>
    @media print {
        html::after {
            content: url("/templates/l2b/endpoints/matamo-print.php<?php echo $piwik_url; ?>");
        }
    }
    </style>
    <!-- End Matamo Code -->
    <?php endif; */?>

    <?php echo BlocksHelper::getSpriteHtml(); // prints sprite (cached) ?>
    <div data-hidden="if-css">
        <fieldset role="presentation">
            <p>
                <strong>Notice:</strong> You are viewing an unstyled version of this page. Are you using an older browser? If so, <a href="https://browsehappy.com/?locale=en">please consider upgrading</a>
            </p>
        </fieldset>
    </div>

    <div id="system-message-container" aria-live="polite"></div>

    <?php require_once(__DIR__ . '/' . $inner_structure . '.php'); ?>

    <?php /*

    {% if page.load_highlighter != false %}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    {% endif %}

    */ ?>

    <?php if (!empty($page_script)): ?>
    <script>
        <?php echo $page_script; ?>
    </script>
    <?php endif; ?>

</body>
</html>