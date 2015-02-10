<?php

trait ArrayAccess
{
    /**
     * Key to set
     * @param mixed $offset
     * @param mixed $value
     * @throws \Exception
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->data[] = $value;
        } else {
            $this->data[$key] = $value;
        }
    }
    /**
     * Key to retrieve
     * @param mixed $key
     * @return string
     */
    public function offsetGet($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }
    /**
     * Whether a key exists
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return isset($this->data[$key]);
    }
    /**
     * Key to unset
     * @param mixed $key
     */
    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }
}
