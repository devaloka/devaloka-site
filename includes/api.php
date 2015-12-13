<?php
/**
 * Devaloka Site Template API.
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

if (!function_exists('devaloka_site')) {
    /**
     * @return Devaloka\Plugin\Site\SiteInterface|\Devaloka\Common\NullObject
     */
    function devaloka_site()
    {
        return devaloka_get('devaloka.plugin.site');
    }
}

if (!function_exists('deva_site')) {
    /**
     * @see devaloka_site() :alias:
     *
     * @return Devaloka\Plugin\Site\SiteInterface|\Devaloka\Common\NullObject
     */
    function deva_site()
    {
        return devaloka_site();
    }
}

if (!function_exists('dl_site')) {
    /**
     * @see devaloka_site() :alias:
     *
     * @return Devaloka\Plugin\Site\SiteInterface|\Devaloka\Common\NullObject
     */
    function dl_site()
    {
        return devaloka_site();
    }
}
