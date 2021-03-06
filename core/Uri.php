<?php

/** 
 * Http Class
 * @author Acidvertigo MIT Licence 
 */

namespace Acd;

use \Acd\Http;

/**
 * Description of Uri
 *
 * @author Acidvertigo
 */
class Uri {
	
    private $http;
	
    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    /**
     * returns the current url
     * @return bool|string the current url
     */
    public function getUrl() {
        $url = ($this->http->isSsl() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
        return filter_var($url, FILTER_SANITIZE_URL);
    }
}
