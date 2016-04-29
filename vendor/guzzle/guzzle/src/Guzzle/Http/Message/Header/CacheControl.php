<?php

namespace Guzzle\Http\Message\Header;

use Guzzle\Http\Message\Header;

/**
 * Provides helpful functionality for Cache-Control headers
 */
class CacheControl extends Header
{
    /** @var array */
    protected $directives;

    public function add($value)
    {
        parent::add($value);
        $this->directives = null;
    }

    public function removeValue($searchValue)
    {
        parent::removeValue($searchValue);
        $this->directives = null;
    }

    /**
     * Check if a specific cache controllers directive exists
     *
     * @param string $param Directive to retrieve
     *
     * @return bool
     */
    public function hasDirective($param)
    {
        $directives = $this->getDirectives();

        return isset($directives[$param]);
    }

    /**
     * Get a specific cache controllers directive
     *
     * @param string $param Directive to retrieve
     *
     * @return string|bool|null
     */
    public function getDirective($param)
    {
        $directives = $this->getDirectives();

        return isset($directives[$param]) ? $directives[$param] : null;
    }

    /**
     * Add a cache controllers directive
     *
     * @param string $param Directive to add
     * @param string $value Value to set
     *
     * @return self
     */
    public function addDirective($param, $value)
    {
        $directives = $this->getDirectives();
        $directives[$param] = $value;
        $this->updateFromDirectives($directives);

        return $this;
    }

    /**
     * Remove a cache controllers directive by name
     *
     * @param string $param Directive to remove
     *
     * @return self
     */
    public function removeDirective($param)
    {
        $directives = $this->getDirectives();
        unset($directives[$param]);
        $this->updateFromDirectives($directives);

        return $this;
    }

    /**
     * Get an associative array of cache controllers directives
     *
     * @return array
     */
    public function getDirectives()
    {
        if ($this->directives === null) {
            $this->directives = array();
            foreach ($this->parseParams() as $collection) {
                foreach ($collection as $key => $value) {
                    $this->directives[$key] = $value === '' ? true : $value;
                }
            }
        }

        return $this->directives;
    }

    /**
     * Updates the header value based on the parsed directives
     *
     * @param array $directives Array of cache controllers directives
     */
    protected function updateFromDirectives(array $directives)
    {
        $this->directives = $directives;
        $this->values = array();

        foreach ($directives as $key => $value) {
            $this->values[] = $value === true ? $key : "{$key}={$value}";
        }
    }
}
