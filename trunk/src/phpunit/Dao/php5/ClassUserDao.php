<?php
class UserDao extends Ddth_Dao_AbstractDao {
    public function getConnection($startTransaction = FALSE) {
        return NULL;
    }

    public function closeConnection($hasError = FALSE, $forceClose = FALSE) {

    }
}
?>
