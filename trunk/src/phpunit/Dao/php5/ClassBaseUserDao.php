<?php
abstract class BaseUserDao extends Ddth_Dao_AbstractSqlStatementDao implements Ddth_Dao_IDao {

    /**
     * Fetches result from the result set and returns as an associative array.
     *
     * @param resource $rs
     */
    protected abstract function fetchResultAssoc($rs);

    /**
     * Fetches result from the result set and returns as an index array.
     *
     * @param resource $rs
     */
    protected abstract function fetchResultArr($rs);

    /**
     * Counts number of current users.
     *
     * @return int
     */
    public function countUsers() {
        $sqlStm = $this->getSqlStatement('sql.countUsers');
        $wrappedConn = $this->getConnection();

        $rs = $sqlStm->execute($wrappedConn->getConn());
        $result = $this->fetchResultArr($rs);

        $this->closeConnection();
        return $result[0];
    }

    /**
     * Create a new user.
     *
     * @param int $id
     * @param string $username
     * @param string $email
     */
    public function createUser($id, $username, $email) {
        $sqlStm = $this->getSqlStatement('sql.createUser');
        $wrappedConn = $this->getConnection();

        $params = Array('id' => $id, 'username' => $username, 'email' => $email);
        $result = $sqlStm->execute($wrappedConn->getConn(), $params);

        $this->closeConnection();
        return $result;
    }

    /**
     * Deletes a new user.
     *
     * @param int $id
     */
    public function deleteUser($id) {
        $sqlStm = $this->getSqlStatement('sql.deleteUserById');
        $wrappedConn = $this->getConnection();

        $params = Array('id' => $id);
        $result = $sqlStm->execute($wrappedConn->getConn(), $params);

        $this->closeConnection();
        return $result;
    }

    /**
     * Gets a user by id.
     *
     * @param int $id
     * @retyrn array
     */
    public function getUserById($id) {
        $sqlStm = $this->getSqlStatement('sql.selectUserById');
        $sqlConn = $this->getConnection();

        $params = Array('id' => $id);
        $rs = $sqlStm->execute($sqlConn->getConn(), $params);
        $result = $this->fetchResultAssoc($rs);
        //$result = sqlite_fetch_array($rs, SQLITE_ASSOC);

        $this->closeConnection();
        return $result !== FALSE ? $result : NULL;
    }
}
?>
