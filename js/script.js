/*------------------------------------------------------------------------------------------------*\
    Fall-Back Cookie Notice Pattern v3.0
    ------------------------------------

    To avoid any confusion, it's probably best to copy these settings to another file that you're
    concatenating and then make any changes to the defaults.
\*------------------------------------------------------------------------------------------------*/

// Settings used in HTML.
// MAY BE Removed: I'm considering moving the HTML into the main template markup via a
// `<script type="template">` tag. If I do, these won't be necessary.


// Settings used to generate cookie.
// If I remove the HTML settings, I'd be tempted to remove these too, perhaps as attributes to the
// script tag. Then I won't need this file at all, and I've never liked having to configure JS in
// this way. I've always preferred doing it via markup.
// Not sure of the best way to handle this though:

// Example 1 (attribute-based):
// `<script type="template" cookie_notice cookie_notice_name="cookie_notice" cookie_expire_days="60" cookie_notice_effect_duration="1000">`

// Example 2 (JSON):
// `<script type="template" cookie_notice="{name:'cookie_notice', expire_days:60, effect_duration:1000}">`

// Example 3: (function-esque)
// `<script type="template" cookie_notice="cookie_notice, 60, 1000">


var cookie_name                   = 'l2b_accept_cookies';
var member_cookie_name            = 'l2b_member_accept_cookies';
var cookie_expire_days            = 60;
var cookie_notice_effect_duration = 1000;
var cookie_notice_id              = 'cookie_notice';
var cookie_button_id              = 'accept_cookies';

var cookie_notice_class           = 'cookie_notice';
var cookie_notice__message_class  = 'cookie_notice__message';
var cookie_notice__action_class   = 'cookie_notice__action';
var cookie_button_class           = 'cookie_notice__button';


var cookie_html_classes           =
'<div id="' + cookie_notice_id + '" class="' + cookie_notice_class + '">' + "\n" +
'    <fieldset role="presentation">' + "\n" +
'        <p class="cookie_notice__message">This site uses <a href="http://www.allaboutcookies.org/" rel="external noopener noreferrer" target="_blank">cookies</a> to improve user experience. By using this site you agree to our use of cookies.</p>' + "\n" +
'        <p class="cookie_notice__action"><button id="' + cookie_button_id + '" class="' + cookie_button_class + '">Dismiss</button></p>' + "\n" +
'    </fieldset>';
'</div>';


var member_cookie_html_classes           =
'<div id="' + cookie_notice_id + '" class="' + cookie_notice_class + '">' + "\n" +
'    <fieldset role="presentation">' + "\n" +
'        <p class="cookie_notice__message">As a registered user, we collect more detailed usage data (linked to your account) to improve the Toolkit. You can opt out in your settings or via our <a href="/privacy-cookies">Privacy Notice</a>.</p>' + "\n" +
'        <p class="cookie_notice__action"><button id="' + cookie_button_id + '" class="' + cookie_button_class + '">Dismiss</button></p>' + "\n" +
'    </fieldset>';
'</div>';

// Switch this if using elements:
var cookie_html = cookie_html_classes;

/* ---------------------------------------------------------------------------------------------- */

/*!
    Fall-Back Patterns - Base JS
    https://github.com/Fall-Back/Patterns/tree/master/
    Copyright (c) 2022, Andy Kirk
    Released under the MIT license https://git.io/vwTVl
*/

// Utilties and Polyfills common to Fall-Back Patterns.
// Creates a single global var called $flbk.
// Must be in the markup AFTER the main stylesheet

// POLYFILLS
// Remove polyfill:
(function() {
    function remove() { this.parentNode && this.parentNode.removeChild(this); }
    if (!Element.prototype.remove) Element.prototype.remove = remove;
    if (Text && !Text.prototype.remove) Text.prototype.remove = remove;
})();


var $flbk = {};


// SETTINGS AND UTILITIES
(function($flbk) {
    $flbk.s = {};
    $flbk.u = {};


    $flbk.u.css_has_rule = function(selector) {

        if ($flbk.s.debug) {
            console.log('Checking for CSS rule:', selector);
        }

        var rules;
        var haveRule = false;
        if (typeof document.styleSheets != "undefined") { // is this supported
            var cssSheets = document.styleSheets;


            // IE doesn't have document.location.origin, so fix that:
            if (!document.location.origin) {
                document.location.origin = document.location.protocol + "//" + document.location.hostname + (document.location.port ? ':' + document.location.port: '');
            }
            var domain_regex  = RegExp('^' + document.location.origin);

            outerloop:
            for (var i = 0; i < cssSheets.length; i++) {
                var sheet = cssSheets[i];

                // Some browsers don't allow checking of rules if not on the same domain (CORS), so
                // checking for that here:
                if (sheet.href !== null && domain_regex.exec(sheet.href) === null) {
                    continue;
                }

                // Check for IE or standards:
                rules = (typeof sheet.cssRules != "undefined") ? sheet.cssRules : sheet.rules;

                for (var j = 0; j < rules.length; j++) {
                    if (rules[j].selectorText == selector) {
                        haveRule = true;
                        break outerloop;
                    }
                }
            }
        }

        if ($flbk.s.debug) {
            console.log(selector + ' ' + (haveRule ? '' : 'not') + ' found');
        }

        return haveRule;
    };


    $flbk.u.css_rule_applied = function(selector, property, value) {
        var el = document.querySelector(selector);
        var style = window.getComputedStyle(el);
        if (property in style) {
            if (style[property] == value) {
                return true;
            }
        }
        return false;
    };


    $flbk.u.debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this;
            var args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) {
                    func.apply(context, args);
                }
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) {
                func.apply(context, args);
            }
        };
    }


    $flbk.u.ready = function(fn) {
        if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading") {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    };


    $flbk.u.set_style = function(element, style) {
        Object.keys(style).forEach(function(key) {
            var val = style[key];
            if (val.indexOf(' !important' ) !== -1) {
                val = val.replace(' !important', '');
                element.style.setProperty(key, val, 'important');
            } else {
                element.style.setProperty(key, val);
            }
        });
    }




    //$flbk.s.debug = true;
    $flbk.s.debug = false;

    $flbk.s.main_stylesheet_id = 'main_stylesheet';
    $flbk.s.support_ie11 = true;
    $flbk.s.ie11 = $flbk.s.support_ie11 && (!!window.MSInputMethodContext && !!document.documentMode);
    $flbk.s.media_to_match   = false;
    $flbk.s.media_is_matched = false;
    $flbk.s.general_css_check_selector = "#css_has_loaded";
    $flbk.s.general_css_check_property = "visibility";
    $flbk.s.general_css_check_value    = "hidden";
    $flbk.s.general_css_is_loaded = false;
    $flbk.s.general_css_is_present = false;

    var main_stylesheet_el = document.getElementById($flbk.s.main_stylesheet_id);
    if ($flbk.s.debug) {
        console.log('main_stylesheet_el:', main_stylesheet_el);
    }

    if (main_stylesheet_el) {
        $flbk.s.media_to_match = main_stylesheet_el.media;
        var mq = window.matchMedia($flbk.s.media_to_match);
        if ($flbk.s.debug) {
            console.log('mq:', mq.matches);
        }
        $flbk.s.media_is_matched = mq.matches;
    }


    $flbk.s.general_css_is_loaded = $flbk.u.css_has_rule($flbk.s.general_css_check_selector);
    if ($flbk.s.debug) {
        console.log('general_css_is_loaded:', $flbk.s.general_css_is_loaded);
    }

    $flbk.s.general_css_is_present = $flbk.s.general_css_is_loaded && ($flbk.s.media_is_matched || $flbk.s.ie11);

    if ($flbk.s.debug) {
        console.log('general_css_is_present:', $flbk.s.general_css_is_present);
    }

})($flbk);
/*! --------------------------------------------------------------------------------------------- *\

    Fall-Back Close Button v3.0.0
    https://github.com/Fall-Back/Patterns/tree/master/Close%20Button
    Copyright (c) 2021, Andy Kirk
    Released under the MIT license https://git.io/vwTVl

    Designed for use with the EM2 [CSS Mustard Cut](https://github.com/Fall-Back/CSS-Mustard-Cut)
    Edge, Chrome 39+, Opera 26+, Safari 9+, iOS 9+, Android ~5+, Android UCBrowser ~11.8+
    FF 47+

    PLUS IE11

\* ---------------------------------------------------------------------------------------------- */

(function() {

    var close_button_container_selector    = '[data-js="close-button"]';
    var close_button_focus_target_selector = 'h1[tabindex=\'-1\']';
    var close_button_class                 = 'close-button';
    var close_button_id                    = '';
    var close_button_effect_duration       = 1000;

    var close_button_container_class       = 'js-close-button-container';

    var close_button_class_string = '';
    if (close_button_class) {
        close_button_class_string = ' class="' + close_button_class +'"';
    }

    var close_button_id_string = '';
    if (close_button_id) {
        close_button_id_string = ' class="' + close_button_id +'"';
    }

    // Focus HAS to move somewhere so default to h1. May rethink this...
    if (!close_button_focus_target_selector) {
        close_button_focus_target_selector = 'h1';
    }

    var close_button_focus_target_selector_string = ' data-js-focus-target="' + close_button_focus_target_selector +'"';


    var close_button_html  =
'<button' + close_button_id_string + close_button_class_string + close_button_focus_target_selector_string + '>' +
'    <span hidden="" aria-hidden="false">Close</span>' +
'    <svg width="1.25em" height="1.25em" aria-hidden="true" focusable="false" display="inline"><use href="#blocksicon-x"></use></svg>' +
'</button>' + "\n";

    var $close_button = {

        close_buttons: null,
        close_button_containers: null,

        init: function() {
            var self = this;

            $close_button.close_button_containers = document.querySelectorAll(close_button_container_selector);

            Array.prototype.forEach.call($close_button.close_button_containers, function (close_button_container, i) {

                close_button_container.className += '  ' + close_button_container_class;

                close_button_container.innerHTML += close_button_html;

                var close_button = close_button_container.lastElementChild;

                close_button.addEventListener('click', function(e) {
                    e.preventDefault();

                    close_button_container.setAttribute('data-close', true);

                    setTimeout(function(){
                        close_button_container.parentNode.removeChild(close_button_container);
                    }, close_button_effect_duration);

                    document.querySelector(this.getAttribute('data-js-focus-target')).focus();
                });
            });
        }
    }

    $flbk.u.ready($close_button.init);
})();

/*!
    Fall-Back Cookie Notice v3.0.0
    https://github.com/Fall-Back/Cookie-Notice
    Copyright (c) 2017, Andy Kirk
    Released under the MIT license https://git.io/vwTVl
*/
(function() {
    var createCookie = function(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }

    var readCookie = function(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    var eraseCookie = function(name) {
        createCookie(name,"",-1);
    }

    var $cookienotice = {

        init: function () {
            var accepted_cookies = readCookie(cookie_name);
            var accepted_member_cookies = readCookie(member_cookie_name);
            var body_el = document.getElementsByTagName('body')[0];
            console.log('is member: ' + document.isMember);
            console.log('accepted_member_cookies: ' + accepted_member_cookies);
            if (document.isMember && !accepted_member_cookies) {
                body_el.insertAdjacentHTML('afterbegin', member_cookie_html_classes);

                document.getElementById(cookie_button_id).onclick = function(){
                    createCookie(member_cookie_name, 'true', cookie_expire_days);
                    createCookie(cookie_name, 'true', cookie_expire_days);
                    document.getElementById(cookie_notice_id).setAttribute('data-close', true);
                    //document.getElementById(cookie_notice_id).className += '  ' + cookie_close_class;
                    /*
                        Without CSS (or transition support - IE9) the notice won't disappear, so wait until fade
                        has finished then remove:
                    */
                    setTimeout(function(){
                        var c = document.getElementById(cookie_notice_id);
                        c.parentNode.removeChild(c);
                    }, cookie_notice_effect_duration);
                };
            } else if (!accepted_cookies) {

                body_el.insertAdjacentHTML('afterbegin', cookie_html);

                document.getElementById(cookie_button_id).onclick = function(){
                    createCookie(cookie_name, 'true', cookie_expire_days);
                    document.getElementById(cookie_notice_id).setAttribute('data-close', true);
                    //document.getElementById(cookie_notice_id).className += '  ' + cookie_close_class;
                    /*
                        Without CSS (or transition support - IE9) the notice won't disappear, so wait until fade
                        has finished then remove:
                    */
                    setTimeout(function(){
                        var c = document.getElementById(cookie_notice_id);
                        c.parentNode.removeChild(c);
                    }, cookie_notice_effect_duration);
                };
            }
        }
    }

    $flbk.u.ready($cookienotice.init);
})();

/* ---------------------------------------------------------------------------------------------- */
