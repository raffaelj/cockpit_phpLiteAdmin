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

        // make variables global to avoid namespace issues in included phpliteadmin.php
        global $databases, $lang, $charsNum, $allowed_extensions, $debug;

        $password = '';                               // skip login page
        $directory = COCKPIT_STORAGE_FOLDER.'/data';  // set data dir
        $language = $this('i18n')->locale;            // set language

        if (!empty($this->config['rowsNum']))             $rowsNum = $this->config['rowsNum'];
        if (!empty($this->config['charsNum']))            $charsNum = $this->config['charsNum'];
        if (!empty($this->config['maxSavedQueries']))     $maxSavedQueries = $this->config['maxSavedQueries'];
        if (!empty($this->config['cookie_name']))         $cookie_name = $this->config['cookie_name'];
        if (!empty($this->config['debug']))               $debug = $this->config['debug'];

        include($this->path('phpliteadmin:phpliteadmin.php'));

    }

    public function css() {

        if(!$this->module('cockpit')->isSuperAdmin())
            return $this->helper('admin')->denyRequest();

        $theme = !empty($this->config['theme']) ? $this->config['theme'] : 'Default/phpliteadmin.css';

        if (strpos($theme, '/') === false)
            $theme .= '/phpliteadmin.css';

        $this->app->response->mime = 'css';

        if ($themefile = $this->path("#config:phpliteadmin/themes/$theme"))
            include($themefile);
        else
            include($this->path('phpliteadmin:themes/'.$theme));

    }

}