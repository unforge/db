<?php
/**
 * This file is part of the Db library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ronam Unstirred (unforge.coder@gmail.com)
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace Unforge\Toolkit;

use mysqli;
use mysqli_result;

/**
 * Class Db
 *
 * @package Unforge\Toolkit
 */
class Db
{
    /**
     * @var MySQLi
     */
    private static $db_connect;

    /**
     * @var array
     */
    protected static $default_settings = [
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'passwd'        => '',
        'port'          => 3306,
        'database'      => 'test',
        'db_settings'   => [
            'names'         => 'utf8',
            'sql_mode'      => ''
        ]
    ];

    /**
     * @var array
     */
    private static $settings = [];

    /**
     * Tools constructor.
     * @param Configurator|null $configurator
     *
     * @throws \ReflectionException
     */
    public function __construct(Configurator $configurator = null)
    {
        if ($configurator) {
            static::$settings = $configurator->getConfigByObject($this);
        }
    }

    /**
     * @return array
     */
    public static function getSettings() : array
    {
        $host           = static::$settings['host'] ?? static::$default_settings['host'];
        $username       = static::$settings['username'] ?? static::$default_settings['username'];
        $passwd         = static::$settings['passwd'] ?? static::$default_settings['passwd'];
        $port           = static::$settings['port'] ?? static::$default_settings['port'];
        $database       = static::$settings['database'] ?? static::$default_settings['database'];
        $db_settings    = static::$settings['db_settings'] ?? static::$default_settings['db_settings'];

        return [$host, $username, $passwd, $port, $database, $db_settings];
    }

    /**
     * Open Db connect
     */
    protected static function connect() : void
    {
        if (!static::$db_connect) {
            [$host, $username, $passwd, $port, $database, $db_settings] = static::getSettings();

            static::$db_connect = new mysqli($host, $username, $passwd, $port);

            if (static::$db_connect->connect_errno) {
                throw new \RuntimeException(
                    "Failed connection to mysqli://{$username}@{$host}:{$port}/{$database} (" .
                    ($passwd ? "with" : "without") . " password): " .
                    static::$db_connect->connect_error,
                    static::$db_connect->connect_errno
                );
            }

            if (!is_array($db_settings)) {
                static::disconnect();
    
                throw new \UnexpectedValueException(
                    "Db settings {$db_settings} is not valid format " .
                    "Default valid format " . var_export(static::$default_settings['db_settings'], true)
                );
            }

            foreach ($db_settings as $key => $value) {
                $key = mb_strtoupper($key);
    
                if (!is_scalar($value)) {
                    static::disconnect();

                    throw new \UnexpectedValueException(
                        "Value " . var_export($value, true) . " is not scalar"
                    );
                }

                static::query("SET $key=" . var_export($value, true));
            }
        }
    }

    /**
     * Close Db connect
     */
    protected static function disconnect() : void
    {
        if (static::$db_connect) {
            static::$db_connect->close();
            static::$db_connect = null;
        }
    }

    /**
     * Reload Db connect
     */
    protected static function reconnect() : void
    {
        static::disconnect();
        static::connect();
    }

    /**
     * @param string $query
     */
    protected static function query(string $query)
    {
        // todo
    }

    /**
     * Return Raw results from BD
     *
     * @param string $query
     *
     * @return mixed
     */
    public static function fetchRaw(string $query)
    {
        return static::query($query);
    }

    /**
     * Return one Cell results from BD
     *
     * @param string $table_name
     * @param string $field
     * @param array $where
     *
     * @return string|int
     */
    public static function fetchCell(string $table_name, string $field, array $where = [])
    {
        // todo
    }

    /**
     * Return one Column results from BD
     *
     * @param string $table_name
     * @param string $field
     * @param array $where
     *
     * @return array
     */
    public static function fetchColl(string $table_name, string $field, array $where = []) : array
    {
        // todo
    }

    /**
     * Return one Row results from BD
     *
     * @param string $table_name
     * @param array $where
     *
     * @return array
     */
    public static function fetchRow(string $table_name, array $where = []) : array
    {
        // todo
    }

    /**
     * Return All results from BD
     *
     * @param string $table_name
     * @param array $where
     *
     * @return array
     */
    public static function fetchAll(string $table_name, array $where = []) : array
    {
        // todo
    }

    /**
     * @param string $table_name
     * @param array $data
     */
    public static function insert(string $table_name, array $data = [])
    {
        // todo
    }

    /**
     * @param string $table_name
     * @param array $data
     * @param array $where
     */
    public static function update(string $table_name, array $data = [], array $where = [])
    {
        // todo
    }

    /**
     * @param string $table_name
     */
    public static function replace(string $table_name)
    {
        // todo
    }

    /**
     * @param string $table_name
     * @param array $where
     */
    public static function delete(string $table_name, array $where = [])
    {
        // todo
    }

    /**
     * @param string $table_name
     * @param string $engine
     * @param array $fields
     */
    public static function createTable(string $table_name, string $engine, array $fields)
    {
        // todo
    }

    /**
     * @param string $table_name
     * @param array $alters
     */
    public static function alterTable(string $table_name, array $alters = [])
    {
        // todo
    }

    /**
     * @param string $table_name
     */
    public static function dropTable(string $table_name)
    {
        // todo
    }

    public static function begin()
    {
        // todo
    }

    public static function commit()
    {
        // todo
    }

    public static function rollback()
    {
        // todo
    }
}
