<?php


class BaseController
{
    protected $view;

    public function __construct()
    {
        $this->view = new stdClass();
    }

    public function getView() {
        return $this->view;
    }
}