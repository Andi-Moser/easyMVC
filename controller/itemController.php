<?php


class itemController extends BaseController
{
    /**
     * @Route("/list/?")
     * @Route("/item/list")
     */
    public function listAction() {
        $model = new Item();

        $items = $model->getItems();

        $this->view->items = $items;
    }

    /**
     * @Route("/save")
     */
    public function saveAction() {
        return new Redirect("/list");
    }
}