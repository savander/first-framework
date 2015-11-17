<?php


class Router
{

    /**
     * @var array Array of routes
     */
    protected $m_Routes = [];


    public function add($callType, $path, $target)
    {
        $this->m_Routes = [$callType, $path, $target];


    }
}