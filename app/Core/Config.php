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
     * Reference to DotNotation class
     * @var dotnotation class
     */
    protected $m_DotNotationInstance;

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
     * Load settings from specific file
     *
     * Supported types:
     * - PHP (return array())
     * - JSON
     * - INI
     *
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
                    if(!is_file($configLocation))
                    {
                        $this->m_ConfigItems[$file] = json_decode(file_get_contents($configLocation), true);
                    }
                    break;
                case 'ini':
                    $configLocation = $item.DIRECTORY_SEPARATOR.$file.'.ini';
                    if(!is_file($configLocation))
                    {
                        $this->m_ConfigItems[$file] = parse_ini_file($configLocation, true);
                    }
                    break;
                default:
                    throw new InvalidArgumentException(sprintf('The file %s not exists!', $item));
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
     *
     * @param $path
     * @return array|bool
     */
    public function get($path)
    {
        return $this->m_DotNotationInstance->get($path, false);
    }

    /**
     * Set value in config in specific array
     * Using dot notation
     *
     *
     * Usage:
     * $config->set('app.appname', 'newValue');
     *
     *
     * @param string $path
     * @param mixed $value
     */
    public function set($path, $value)
    {
        $this->m_DotNotationInstance->set($path, $value);
    }

    /**
     * Make reference for DotNotation class.
     */
    public function __construct()
    {
        $this->m_DotNotationInstance = new DotNotation($this->m_ConfigItems);
    }

}