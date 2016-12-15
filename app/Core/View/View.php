<?php

class View
{
    /**
     * Template name
     * @var
     */
    protected $m_Template;

    /**
     * Data which will be casted to template
     * @var array
     */
    protected $m_Data = array();

    /**
     * Default template path
     * @var
     */
    protected $m_TemplatePath = ROOT_DIR . 'templates' . DIRECTORY_SEPARATOR;

    /**
     * Initialize new View
     * @param $template
     */
    public function __construct($template)
    {
        $this->m_Template = $template;
        return $this;
    }


    /**
     * Make a view
     * @param $template
     * @return View
     */

    public static function make($template)
    {
        return new self($template);
    }

    /**
     * Passing data to view
     * @param array $data
     * @return $this
     */
    public function with(Array $data){
        $this->m_Data = $data;
        return $this;
    }

    /**
     * Render function
     * @return string
     */
    public function render()
    {
        /**
         * Extract $this->m_Data to standalone variables
         */
        extract($this->m_Data);
        global $config;

        ob_start();
        include($this->m_TemplatePath . $this->m_Template.'.php');
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }


    /**
     * Escape input from special chars (like <>)
     * @param $input
     * @return string
     */
    public function h($input)
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}