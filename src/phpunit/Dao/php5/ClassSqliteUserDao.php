<?php
class SqliteUserDao extends BaseUserDao implements Ddth_Dao_Sqlite_ISqliteDao {

    protected function initSqlStatementFactory() {
        $this->setSqlStatementFile('user.sqlite.properties');
        parent::initSqlStatementFactory();
    }

    protected function fetchResultAssoc($rs) {
        return sqlite_fetch_array($rs, SQLITE_ASSOC);
    }

    protected function fetchResultArr($rs) {
        return sqlite_fetch_array($rs, SQLITE_NUM);
    }
}
?>
