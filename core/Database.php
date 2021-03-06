<?php

/**
 * The MIT License
 *
 * Copyright 2015 Acidvertigo.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Acd;

/**
 * Database connection class
 *
 * @author Acidvertigo
 */
class Database
{

    /** @var array $config Configuration array */
    private $config = null;
    /** @var \PDO $connection Connection object */
    private $connection = null;

    public function __construct(Config $config) {
        $this->config = $config->get('database');
    }

    /**
     * Connects to the database
     * @throws \PDOException
     * @return \PDO
     */
    public function connect()
    {
        try {
                $options = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, 
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING];

                // Starts connection
                $this->connection = new \PDO('mysql:host=' . $this->config['HOST'] . ';dbname=' . $this->config['NAME'], 
                                                $this->config['USERNAME'], 
                                                $this->config['PASSWORD'], 
                                                $options);
            } catch (\PDOException $e) {
                throw $e;
            }

        return $this->connection;
    }

    /**
     * Close database connection
     */
    public function disconnect()
    {
        $this->connection = null;
    }

    /**
     * Check if called method exists in pdo class and returns it
     * @return function The called function
     */
    public function __call($method, $args)
    {
        $callable = [$this->connection, $method];
        if (is_callable($callable))
        {
            return call_user_func_array($callable, $args);
        }
    }
}
