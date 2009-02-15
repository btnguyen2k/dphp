<?php
class UserDao implements Ddth_Dao_Adodb_IAdodbBoManager {
    
    private $daoFactory;
    
    public function delete($bo) {
    }

    public function get($id) {
    }

    public function save($bo) {
    }

    public function update($bo) {
    }

    public function init($daoFactory) {
        $this->daoFactory = $daoFactory;
    }
}
?>