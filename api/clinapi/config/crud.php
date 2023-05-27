<?php

interface CRUD{
    public function get();
    public function getOne($id);
    public function add($obj);
    public function update($obj);
}
?>