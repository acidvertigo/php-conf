<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd;

/**
 * Description of Uri
 *
 * @author Acidvertigo
 */
class Uri {
	
    private $http;
	
    public function __construct(\Acd\Http $http) {
        $this->http = $http;
    }
	
    /**
     * returns the current url
     * @return bool|string the current url
     */
    public function getUrl() {
        $url = ($this->http->isSsl() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . htmlspecialchars( $_SERVER['REQUEST_URI'], ENT_QUOTES | ENT_HTML5, 'UTF-8' );
        return filter_var($url, FILTER_SANITIZE_URL);
    }
}
