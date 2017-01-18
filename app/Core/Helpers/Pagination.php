<?php

/**
 * Created by PhpStorm.
 * User: Savander
 * Date: 03.01.2017
 * Time: 18:57
 */
class Pagination
{

    protected $m_PageSelector = 'page';
    protected $m_PerPage = 5;
    protected $m_NumRecords = 0;
    public $m_NumPages = 0;

    protected $m_NumVisible = 5;

    protected $m_CssClass = '';

    public function __construct($NumRecords, $PerPage = 10)
    {
        $this->m_NumRecords = $NumRecords;
        $this->m_PerPage = $PerPage;
        $this->m_NumPages = floor($NumRecords/$PerPage);
    }


    /**
     * Get pages count
     * @return float|int
     */
    public function getPagesCount()
    {
        return $this->m_NumPages;
    }

    /**
     * How many pages should be displayed on bar
     * @param $count
     * @return $this
     */
    public function maxVisible($count)
    {
        $this->m_NumVisible = $count;
        return $this;
    }

    /**
     * Determine page selector, which is used to switch pages
     * @param $selector
     * @return $this
     */
    public function setPageSelector($selector)
    {
        $this->m_PageSelector = $selector;
        return $this;
    }


    /**
     * Return's currentPage
     * @return bool|string
     */
    public function getCurrentPage(){
        return intval(Request::get($this->m_PageSelector));
    }


    /**
     * Set class used to stylize page bar
     * @param $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->m_CssClass = $class;
        return $this;
    }
    /**
     * Render pagination bar
     */
    public function render()
    {
        echo "
            <div class='" . $this->m_CssClass . "'>
                
            </div>
        ";
    }
}