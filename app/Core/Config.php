<?php

class Config
{
    /**
     * Stored paths, where we will search for configs.
     * @var array
     */
    public $m_Paths = [];

    /**
     * Stored config items in array
     * @var array
     */
    public $m_ConfigItems = [];

    /**
     * Add paths to search for configs
     * @param array $_paths
     */
    public function addPaths($_paths = [])
    {
        foreach ($_paths as $item)
        {
            $this->m_Paths[] = $item;
        }
    }


    /**
     * Load settings from file
     * @param $file
     * @param string $type
     * @return bool
     */
    public function load($file, $type = 'php')
    {
        foreach($this->m_Paths as $item)
        {
            switch($type)
            {
                case 'php':
                    $configLocation = $item.DIRECTORY_SEPARATOR.$file.'.php';
                    if(file_exists($configLocation))
                    {
                        $this->m_ConfigItems[$file] = include_once $configLocation;
                    }
                    break;

                case 'json':
                    $configLocation = $item.DIRECTORY_SEPARATOR.$file.'.json';
                    if(file_exists($configLocation))
                    {
                        $this->m_ConfigItems[$file] = json_decode(file_get_contents($configLocation), true);
                    }
                    break;
                case 'ini':
                    $configLocation = $item.DIRECTORY_SEPARATOR.$file.'.ini';
                    if(file_exists($configLocation))
                    {
                        $this->m_ConfigItems[$file] = parse_ini_file($configLocation, true);
                    }
                    break;
                default:
                    return false;
            }
        }
    }

    /**
     * Returns item if exists in array.
     * Using dot notation
     *
     * Usage:
     * $config->get('app.appname');
     *
     * @author Anton Medvedev <anton (at) elfet (dot) ru>
     *
     * @param $path
     * @return bool
     */
    public function get($path, $default = false)
    {
        $array = $this->m_ConfigItems;
        if (!empty($path)) {
            $keys = $this->explode($path);
            foreach ($keys as $key) {
                if (isset($array[$key])) {
                    $array = $array[$key];
                } else {
                    return $default;
                }
            }
        }
        return $array;
    }

    /**
     * @author Anton Medvedev <anton (at) elfet (dot) ru>
     *
     * @param string $path
     * @param mixed $value
     */
    public function set($path, $value)
    {
        if (!empty($path)) {
            $at = & $this->m_ConfigItems;
            $keys = $this->explode($path);
            while (count($keys) > 0) {
                if (count($keys) === 1) {
                    if (is_array($at)) {
                        $at[array_shift($keys)] = $value;
                    } else {
                        throw new \RuntimeException("Can not set value at this path ($path) because is not array.");
                    }
                } else {
                    $key = array_shift($keys);
                    if (!isset($at[$key])) {
                        $at[$key] = array();
                    }
                    $at = & $at[$key];
                }
            }
        } else {
            $this->m_ConfigItems = $value;
        }
    }

    /**
     * @param $path
     * @return array
     */
    protected function explode($path)
    {
        return preg_split('/[:\.]/', $path);
    }
}