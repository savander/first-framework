<?php
final class Autoload
{
    /**
     * @var The reference to instance of this class
     */
    private static $m_Instance;
    private $m_Directories = [];
    /**
     * Returns the instance of this class. If not exists, create it.
     * @return instance
     */
    public static function getInstance()
    {
        if(self::$m_Instance === null)
        {
            self::$m_Instance = new static();
        }
        return self::$m_Instance;
    }

    /**
     * Add directories to search for classes
     * @param array $_directories
     */
    public function addDirectories($_directories = ['/'])
    {
        foreach($_directories as $item)
        {
            $this->m_Directories[] = $item;
        }
    }

    /**
     * Return directories
     * @return array
     */
    public function getDirectories()
    {
        return $this->m_Directories;
    }


    public function loadClasses($className)
    {
        foreach($this->m_Directories as $item)
        {
            $classLocation = $item.DIRECTORY_SEPARATOR.$className.'.php';
            if(file_exists($classLocation))
            {
                include_once $classLocation;
            }
        }
    }

    /**
     * Protected constructor to prevent creating a new instance
     * via the `new` operator from outside of this class.
     */
    protected function __construct(){}

    /**
     * Private clone method to prevent cloning of the instance of the instance.
     * @return void
     */
    private function __clone(){}
}
