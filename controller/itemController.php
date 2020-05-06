<?php


class itemController extends BaseController
{
    /**
     * @Route("/list/?")
     * @Route("/item/list")
     */
    public function listAction() {
        $this->view->items = [
            [
                "id" => 1,
                "count" => 2,
                "name" => "Oranges"
            ],
            [
                "id" => 2,
                "count" => 1,
                "name" => "Bottle of coca cola"
            ],
            [
                "id" => 3,
                "count" => 5,
                "name" => "Apples"
            ]
        ];
    }

    /**
     * @Route("/save")
     */
    public function saveAction() {
        return new Redirect("/list");
    }
}