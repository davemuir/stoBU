<?php

namespace Concrete\Core\Http;

use Loader;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

/**
 * @package    Core
 * @category   Concrete
 * @author     Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 *
 */

/**
 * An object that represents a particular request to the Concrete-powered website. The request object then determines what is being requested, based on the path, and presents itself to the rest of the dispatcher (which loads the page, etc...)
 *
 * @package    Core
 * @author     Andrew Embler <andrew@concrete5.org>
 * @category   Concrete
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 *
 */
class Request extends SymfonyRequest
{

    static $_request = null;
    protected $hasCustomRequestUser;
    protected $customRequestUser;
    protected $customRequestDateTime;
    protected $c;

    /**
     * @return Request
     */
    public static function getInstance()
    {
        if (null === static::$_request) {
            static::$_request = static::createFromGlobals();
        }
        return static::$_request;
    }

    public function getCurrentPage()
    {
        return $this->c;
    }

    public function setCurrentPage(\Concrete\Core\Page\Page $c)
    {
        $this->c = $c;
    }

    public function getCustomRequestUser()
    {
        return $this->customRequestUser;
    }

    public function setCustomRequestUser($ui)
    {
        $this->hasCustomRequestUser = true;
        $this->customRequestUser = $ui;
    }

    public function hasCustomRequestUser()
    {
        return $this->hasCustomRequestUser;
    }

    public function getCustomRequestDateTime()
    {
        return $this->customRequestDateTime;
    }

    public function setCustomRequestDateTime($date)
    {
        $this->customRequestDateTime = $date;
    }

    /**
     * Determines whether a request matches a particular pattern
     */
    public function matches($pattern)
    {
        return Loader::helper('text')->match($pattern, $this->getPath());
    }

    /**
     * Returns the full path for a request
     */
    public function getPath()
    {
        $pathInfo = rawurldecode($this->getPathInfo());
        $path = '/' . trim($pathInfo, '/');
        return ($path == '/') ? '' : $path;
    }

    /**
     * If no arguments are passed, returns the post array. If a key is passed, it returns the value as it exists in the post array.
     * If a default value is provided and the key does not exist in the POST array, the default value is returned
     *
     * @param string $key
     * @param mixed  $defaultValue
     * @return mixed $value
     */
    public function post($key = null, $defaultValue = null)
    {
        if ($key == null) {
            return $_POST;
        }
        if (isset($_POST[$key])) {
            return (is_string($_POST[$key])) ? trim($_POST[$key]) : $_POST[$key];
        }
        return $defaultValue;
    }

    /**
     * @param null $key
     * @param null $default_value
     * @return mixed|null
     */
    public function request($key = null, $default_value = null)
    {
        if ($key == null) {
            return $_REQUEST;
        }
        $req = Request::createFromGlobals();
        if ($req->query->has($key)) {
            return $req->query->get($key);
        } else {
            if ($req->request->has($key)) {
                return $req->request->get($key);
            }
        }

        return $default_value;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

}
