<?php


class Item extends BaseModel
{
    public function getItems() {
        return $this->getAll('SELECT * FROM amo_items');
    }
}