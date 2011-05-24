<?php
class PgsqlUserDao extends BaseUserDao implements Ddth_Dao_Pgsql_IPgsqlDao {

    protected function initSqlStatementFactory() {
        $this->setSqlStatementFile('user.pgsql.properties');
        parent::initSqlStatementFactory();
    }

    protected function fetchResultAssoc($rs) {
        return pg_fetch_array($rs, NULL, PGSQL_ASSOC);
    }

    protected function fetchResultArr($rs) {
        return pg_fetch_array($rs, NULL, PGSQL_NUM);
    }
}
?>
