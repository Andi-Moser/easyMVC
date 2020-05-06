<?php


class itemController extends BaseController
{
    /**
     * @Route("/list/?")
     * @Route("/item/list")
     */
    public function listAction() {
        $this->view->items = [
            "test" => 1,
            "test2" => 2,
            "test3" => 3
        ];
    }

    /**
     * @Route("/save")
     */
    public function saveAction() {
        return new Redirect("/list");
    }
}