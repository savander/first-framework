<?php

class Controller
{
    public function index()
    {
        $test = new RankingModel();
        echo $test->getPlayer();
        return View::make('pages/homepage')->with(['title' => 'test'])->render();
    }

    public function post()
    {
        echo Request::getMethodType();
        echo "POST! :D";
    }

    public function put(){
        echo "PUT?";
    }
}