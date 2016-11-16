<?php
/**
 * Created by PhpStorm.
 * User: hungln
 * Date: 11/17/16
 * Time: 1:26 AM
 */

if (! function_exists('csrf_field_encrypt')) {
    /**
     * Generate a CSRF token form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function csrf_field_encrypt()
    {

        return new \Illuminate\Support\HtmlString('<input type="hidden" name="_token" value="'.csrf_token_encrypt().'">');
    }
}

if (! function_exists('csrf_token_encrypt')) {
    /**
     * Get the CSRF token value.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function csrf_token_encrypt()
    {
        $session = app('session');

        if (isset($session)) {
            return encrypt($session->getToken());
        }

        throw new RuntimeException('Application session store not set.');
    }
}