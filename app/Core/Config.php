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
     */
    public function load($file, $type = 'php')
    {
        foreach($this->m_Paths as $item)
        {
            switch($type)
            {
                case 'php':
                    $configLocation = $item.DIRECTORY_SEPARATOR.$file.'.php';
                    break;
                default:
                    $configLocation = $item.DIRECTORY_SEPARATOR.$file.'.php';
            }

            if(file_exists($configLocation))
            {
                $this->m_ConfigItems[$file] = include_once $configLocation;
            }
        }
    }

    /**
     * Return $item if exists in array.
     * Item is exploded by dot ".".
     * To get item enter '<config>.<item>'
     *
     * Example:
     * $config->get('app.appname');
     * @param $item
     * @return bool
     */
    public function get($item)
    {
        $item = explode('.', $item);
        if (array_key_exists($item[0], $this->m_ConfigItems))
        {
            if (array_key_exists($item[1], $this->m_ConfigItems[$item[0]])) {
                return $this->m_ConfigItems[$item[0]][$item[1]];
            }
        }
        return false;
    }
}