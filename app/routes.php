<?php


$route->get('/', function (){
    $pagination = (new Pagination(20))->maxVisible(15)->setPageSelector('page')->setClass('test');

    echo $pagination->render();
});