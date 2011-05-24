<?php
class AdodbUserDao extends Ddth_Dao_AbstractConnDao implements Ddth_Dao_Adodb_IAdodbDao {

    /**
     * Counts number of current users.
     *
     * @return int
     */
    public function countUsers() {
        $adodbConn = $this->getConnection();
        $sql = "SELECT count(*) FROM tbl_user";
        $rs = $adodbConn->Execute($sql);
        $result = $rs->fields[0];
        $rs->Close();
        $this->closeConnection();
        return $result;
    }

    /**
     * Create a new user.
     *
     * @param int $id
     * @param string $username
     * @param string $email
     */
    public function createUser($id, $username, $email) {
        $adodbConn = $this->getConnection();
        $sql = "INSERT INTO tbl_user (id, username, email) VALUES (?, ?, ?)";
        $result = $adodbConn->Execute($sql, Array($id, $username, $email));
        $this->closeConnection();
        return $result ? TRUE : FALSE;
    }

    /**
     * Deletes a new user.
     *
     * @param int $id
     */
    public function deleteUser($id) {
        $adodbConn = $this->getConnection();
        $sql = "DELETE FROM tbl_user WHERE id=?";
        $result = $adodbConn->Execute($sql, Array($id));
        $this->closeConnection();
        return $result ? TRUE : FALSE;
    }

    /**
     * Counts number of current users.
     *
     * @return int
     */
    public function getUserById($id) {
        $adodbConn = $this->getConnection();
        $sql = "SELECT * FROM tbl_user WHERE id=?";
        $rs = $adodbConn->Execute($sql, Array($id));
        if (!$rs->EOF) {
            $result = Array('id' => $rs->fields['id'],
                    'username' => $rs->fields['username'],
                    'email' => $rs->fields['email']);
        } else {
            $result = NULL;
        }
        $rs->Close();
        $this->closeConnection();
        return $result;
    }
}
?>
