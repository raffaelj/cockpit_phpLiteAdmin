<?php

namespace phpLiteAdmin\Controller;

class Admin extends \Cockpit\AuthController {

    public function before() {

        $this->config = $this->retrieve('phpliteadmin', []);

    }

    public function index() {

        if(!$this->module('cockpit')->isSuperAdmin())
            return $this->helper('admin')->denyRequest();

        return $this->render('phpliteadmin:views/pla.php', ['config' => $this->config]);

    }

    public function pla() {

        if(!$this->module('cockpit')->isSuperAdmin())
            return $this->helper('admin')->denyRequest();

        $path = $this->path('phpliteadmin:lib/phpliteadmin.php');

        // return cached javascript
        if ($this->param('resource') == 'javascript') {

            $timestamp = filemtime($path);
            $gmt_timestamp = gmdate(DATE_RFC1123, $timestamp);

            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == strtotime($gmt_timestamp)) {
                header('HTTP/1.1 304 Not Modified');
                $this->app->stop();
            }

            header("Content-Type: text/javascript");
            header('Content-Length: '.filesize($path));
            header('Last-Modified: ' . $gmt_timestamp);
            header('Expires: ' . gmdate(DATE_RFC1123, time() + 31556926));
            header('Cache-Control: max-age=31556926');
            header('Pragma: max-age=31556926');

        }

        // make variables global to avoid namespace issues in included phpliteadmin.php
        global $databases, $lang, $charsNum, $allowed_extensions, $debug;

        $password = '';                               // skip login page
        $directory = COCKPIT_STORAGE_FOLDER.'/data';  // set data dir
        $language = $this('i18n')->locale;            // set language

        $rowsNum         = !empty($this->config['rowsNum'])         ? $this->config['rowsNum']         : 30;
        $charsNum        = !empty($this->config['charsNum'])        ? $this->config['charsNum']        : 300;
        $maxSavedQueries = !empty($this->config['maxSavedQueries']) ? $this->config['maxSavedQueries'] : 10;
        $cookie_name     = !empty($this->config['cookie_name'])     ? $this->config['cookie_name']     : 'pla3412';
        $debug           = !empty($this->config['debug'])           ? $this->config['debug']           : false;

        include($path);

        $this->app->stop();

    }

    public function css() {

        if(!$this->module('cockpit')->isSuperAdmin())
            return $this->helper('admin')->denyRequest();

        $theme = !empty($this->config['theme']) ? $this->config['theme'] : 'Default/phpliteadmin.css';

        if (strpos($theme, '/') === false)
            $theme .= '/phpliteadmin.css';

        if (!$themefile = $this->path("#config:phpliteadmin/themes/$theme"))
            $themefile = $this->path('phpliteadmin:themes/'.$theme);

        $timestamp = filemtime($themefile);
        $gmt_timestamp = gmdate(DATE_RFC1123, $timestamp);

        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == strtotime($gmt_timestamp)) {
            header('HTTP/1.1 304 Not Modified');
            $this->app->stop();
        }

        header("Content-Type: text/css");
        header('Content-Length: '.filesize($themefile));
        header('Last-Modified: ' . $gmt_timestamp);
        header('Expires: ' . gmdate(DATE_RFC1123, time() + 31556926));
        header('Cache-Control: max-age=31556926');
        header('Pragma: max-age=31556926');

        include($themefile);

        $this->app->stop();

    }

}
