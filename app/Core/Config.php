<?php

class Config
{
    /**
     * Stored paths, where we will search for configs.
     * @var array
     */
    protected $m_Paths = [];

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
                $this->m_ConfigItems = include_once $configLocation;
            }
        }
    }

    /**
     * Return $item if exists in array.
     * @param $item
     * @return bool
     */
    public function get($item)
    {
        if(in_array($item, $this->m_ConfigItems))
        {
            return $this->m_ConfigItems[$item];
        }
        return false;
    }
}