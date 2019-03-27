<?php
/**
 * phpLiteAdmin interface for Cockpit CMS
 * 
 * @see       https://github.com/raffaelj/cockpit_phpLiteAdmin
 * @see       https://github.com/agentejo/cockpit/
 * @see       https://www.phpliteadmin.org/
 * 
 * @version   0.1.0
 * @author    Raffael Jesche
 * @license   GPL
 */

if (COCKPIT_ADMIN && !COCKPIT_API_REQUEST) {

    $app->on('admin.init', function() {

        if(!$this->module('cockpit')->isSuperAdmin())
            return;

        $this->bindClass('phpLiteAdmin\\Controller\\Admin', 'phpliteadmin');

        $this->helper('admin')->addMenuItem('modules', [
            'label' => 'phpLiteAdmin',
            'icon'  => 'assets:app/media/icons/database.svg',
            'route' => '/phpliteadmin',
            'active' => strpos($this['route'], '/phpliteadmin') === 0
        ]);

    });

}
