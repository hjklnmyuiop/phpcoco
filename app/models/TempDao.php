<?php
namespace models;

class TempDao extends  BaseDao
{

    public function getList(){
        $data = $this->select('meiyou_admin','*', ['nickname' => '测试']);
       return $data;
    }
}