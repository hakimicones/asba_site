<?php

    class Db {
/* member variables */
    // general
        private $dbname;
        private $charset = 'utf8mb4';
        private $host;
        private $login;
        private $password;
        private $connection;
        private $connected;
        private $arrParams = array();
        private $statement;
        private $errMessage;
        private $lastId;
		public $q;
    // select
        private $arrSelected 	= array();
        private $arrFrom 		= array();
        private $arrJoin 		= array();
        private $arrWhere 		= array();
        private $arrGroupBy 	= array();
        private $arrOrderBy 	= array();
		private $arrLimit 		= array();
    // insert
        private $arrInserting = array();
        private $tableForInsert = '';
    // update
        private $tableToUpdate = '';
        private $arrUpdating = array();
        private $idToUpdate = '';
    // delete
        private $tableForDelete = '';
        private $idToDelete = '';
        
/* member functions */
    // general
        public function setDbname($par) { $this->dbname = $par; }
        public function getDbname() { return $this->dbname; }
        public function setCharset($par) { $this->charset = $par; }
        public function getCharset() { return $this->charset; }
        public function setHost($par) { $this->host = $par; }
        public function getHost() { return $this->host; }
        public function setLogin($par) { $this->login = $par; }
        public function getLogin() { return $this->login; }
        public function setPassword($par) { $this->password = $par; }
        public function getPassword() { return $this->password; }
        public function getConnected() { return $this->connected; }
        public function getErrMessage() { return $this->errMessage; }
        public function getLastId() { return $this->lastId; }
        // query parameter array functions
        public function emptyParams() { $this->arrParams = array(); }
        public function addParamToBind($parName, $parValue) {
            $arraySize = sizeof($this->arrParams);
            $this->arrParams[$arraySize][0] = $parName;
            $this->arrParams[$arraySize][1] = $parValue;
        }

    // select functions
        public function emptySelected() { $this->arrSelected = array(); }
        public function emptyFrom() { $this->arrFrom = array(); }
        public function emptyJoin() { $this->arrJoin = array(); }
        public function emptyWhere() { $this->arrWhere = array(); }
        public function emptyGroupBy() { $this->arrGroupBy = array(); }
        public function emptyOrderBy() { $this->arrOrderBy = array(); }
		public function emptyLimit() { $this->arrLimit = array(); }
		 
        public function resetSelect() { 
            $this->statement = false; // reset the result set
            $this->emptyParams(); // empty bind parameters
            $this->emptySelected(); // empty selected column array
            $this->emptyFrom(); // empty from array
            $this->emptyJoin(); // empty join array
            $this->emptyWhere(); // empty where array
            $this->emptyGroupBy(); // empty group by array
            $this->emptyOrderBy(); // empty order by array
			$this->emptyLimit(); // empty Limit
        }
        public function addSelected($colName, $colAlias) {
            $arraySize = sizeof($this->arrSelected);
            $this->arrSelected[$arraySize][0] = $colName;
            $this->arrSelected[$arraySize][1] = "'".$colAlias."'"; // added single quotes in case of accents in the alias name
        }
		
		
        public function addFrom($tableName) {
            $arraySize = sizeof($this->arrFrom);
            $this->arrFrom[$arraySize] = $tableName;
        }
        public function addJoin($joinType, $tableName, $joinCondition) {
            $arraySize = sizeof($this->arrJoin);
            $this->arrJoin[$arraySize][0] = $joinType;
            $this->arrJoin[$arraySize][1] = $tableName;
            $this->arrJoin[$arraySize][2] = $joinCondition;
        }
        public function addWhere($condition) {
            $arraySize = sizeof($this->arrWhere);
            $this->arrWhere[$arraySize] = $condition;
        }
		public function addLimit($limit) {
            $arraySize = sizeof($this->arrLimit);
            $this->arrLimit[$arraySize] = $limit;
        }
		
        public function addGroupBy($colName) {
            $arraySize = sizeof($this->arrGroupBy);
            $this->arrGroupBy[$arraySize] = $colName;
        }
        public function addOrderBy($colName) {
            $arraySize = sizeof($this->arrOrderBy);
            $this->arrOrderBy[$arraySize] = $colName;
        }

    // insert functions
        public function emptyInserting() { $this->arrInserting = array(); }
        public function resetInsert() { 
            $this->statement = false; // reset the result set
            $this->lastId = null; // reset the last inserted id
            $this->emptyParams(); // empty bind parameters
            $this->emptyInserting(); // empty inserting column array
            $this->tableForInsert = ''; // reset into
        }
        public function addInserting($colName, $colValue) {
            $arraySize = sizeof($this->arrInserting);
            $this->arrInserting[$arraySize][0] = $colName;
            $this->arrInserting[$arraySize][1] = $colValue;
        }
        public function setTableForInsert($tableName) {
            $this->tableForInsert = $tableName;
        }
		
		public function setInsertingRub($rub,$r) {
			$this->addInserting($rub , ':'.$rub); 
			$this->addParamToBind( $rub ,$r );
		
		}
		
		
    // update functions

        public function affected_rows() {
        
            return $this->statement->rowCount();
       
       }



        public function emptyUpdating() { $this->arrUpdating = array(); }
        public function resetUpdate() { 
            $this->statement = false; // reset the result set
            $this->emptyParams(); // empty bind parameters
            $this->emptyUpdating(); // empty updating column array
            $this->tableToUpdate = ''; // reset table
            $this->idToUpdate = ''; // reset id
        }
        public function addUpdating($colName, $colValue) {
            $arraySize = sizeof($this->arrUpdating);
            $this->arrUpdating[$arraySize][0] = $colName;
            $this->arrUpdating[$arraySize][1] = $colValue;
        }
        public function setTableToUpdate($tableName) {
            $this->tableToUpdate = $tableName;
        }
        public function setIdToUpdate($where) {
            $this->idToUpdate = $where;
        }
		
		public function setUpdatingID($rub,$r) {
		
			$this->setIdToUpdate($rub.'= :'.$rub); 
			$this->addParamToBind( $rub ,$r );
		
		}
		
		public function setUpdatingRub($rub,$r) {
			$this->addUpdating($rub , ':'.$rub); 

			$this->addParamToBind( $rub ,$r );
		
		}
		
		
    // delete functions
        public function resetDelete() {
            $this->statement = false; // reset the result set
            $this->emptyParams(); // empty bind parameters
            $this->tableForDelete = ''; // reset table
            $this->idToDelete = ''; // reset id
        }
        public function setTableForDelete($tableName) {
            $this->tableForDelete = $tableName;
        }
        public function setIdToDelete($where) {
            $this->idToDelete = $where;
        }

/* construtors */
        function __construct($parDbName, $parHost, $parLogin, $parPassword, $parCharset='') { 
            $this->dbname = $parDbName;
            $this->host = $parHost;
            $this->login = $parLogin;
            $this->password = $parPassword;
            if ($parCharset != '') { $this->charset = $parCharset; }

            $this->connect();
        }

/* methods */
    // CONNECTION
        public function connect() {
            // reset connection status
            $this->connected = false;
            // reset error message
            $this->errMessage = '';

            try {
                $connString = 'mysql:host=localhost;dbname=asba_site_db;port=3306';
				//sprintf('mysql:dbname=%s;mysql:charset=%s;host=%s;port=3306',$this->dbname, $this->charset, $this->host);
                //$this->connection = new PDO($connString, $this->login, $this->password );
				$this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->login, $this->password);
				
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // [OPTIONAL] stop the execution on error occurring during prepare
                //$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                $this->connected = true;
            }
            catch (PDOException $e) {
				
				echo  $connString.'<br> password : '.$this->password.'<br> user : '.$this->login.'<br>'.$e->getMessage().'<br><br><br>';
				
                $this->errMessage = $e->getMessage();
				
				die($e->getMessage());
            }
        }

    // SELECT
        private function buildSelectQuery() {
            $select = "SELECT";
            $from = "\nFROM";
            $join = "";
            $where = "\nWHERE ";
            $groupby = "\nGROUP BY ";
            $orderby = "\nORDER BY ";
			$limit = "\nLIMIT ";
            $maxSelected = sizeof($this->arrSelected);
            $maxFrom = sizeof($this->arrFrom);
            $maxJoin = sizeof($this->arrJoin);
            $maxWhere = sizeof($this->arrWhere);
            $maxGroupBy = sizeof($this->arrGroupBy);
            $maxOrderBy = sizeof($this->arrOrderBy);
			$maxLimit = sizeof($this->arrLimit);

            // nothing to select
            if ($maxSelected == 0 || $maxFrom == 0) { return ''; }
            
            // selected
            for($i = 0; $i < $maxSelected; $i++) {
               // $select .= ' '.$this->arrSelected[$i][0].' AS '.$this->arrSelected[$i][1].',';
			   
			   if ( $this->arrSelected[$i][1] !="''") {
                $select .= ' '.$this->arrSelected[$i][0].' AS '.$this->arrSelected[$i][1].','; } else  {
				$select .= ' '.$this->arrSelected[$i][0].',';} // if Alias not provided
				 
            
			   
            }
            $select = substr($select, 0, strlen($select)-1); // remove the last comma

            // from
            for($i = 0; $i < $maxFrom; $i++) {
                $from .= ' '.$this->arrFrom[$i].',';
            }
            $from = substr($from, 0, strlen($from)-1); // remove the last comma

            // join
            for($i = 0; $i < $maxJoin; $i++) {
                $join .= "\n".$this->arrJoin[$i][0]
                        .' '.$this->arrJoin[$i][1]
                        .' ON '.$this->arrJoin[$i][2];
            }

            // where
            if ($maxWhere == 0) { $where = ''; }
            else {
                for($i = 0; $i < $maxWhere; $i++) {
                    $where .= ' '.$this->arrWhere[$i].' AND';
                }
                $where = substr($where, 0, strlen($where)-4); // remove the last AND
            }

            // group by
            if ($maxGroupBy == 0) { $groupby = ''; }
            else {
                for($i = 0; $i < $maxGroupBy; $i++) {
                    $groupby .= ' '.$this->arrGroupBy[$i].',';
                }
                $groupby = substr($groupby, 0, strlen($groupby)-1); // remove the last comma
            }

            // order by
            if ($maxOrderBy == 0) { $orderby = ''; }
            else {
                for($i = 0; $i < $maxOrderBy; $i++) {
                    $orderby .= ' '.$this->arrOrderBy[$i].',';
                }
                $orderby = substr($orderby, 0, strlen($orderby)-1); // remove the last comma
            }
			
			// Limit
            if ($maxLimit == 0) { $limit = ''; }
            else {
                for($i = 0; $i < $maxLimit; $i++) {
                    $limit .= ' '.$this->arrLimit[$i].',';
                }
                $limit = substr($limit, 0, strlen($limit)-1); // remove the last comma
            }
			

            $query = $select.$from.$join.$where.$groupby.$orderby.$limit;
            $this->q = $query;
            return $query;
        }

        // prepare query before binding parameters (if any)
        private function prepareQuery($query) {
            try {
                $this->statement = $this->connection->prepare($query);
            }
            catch (PDOException $e) {
                $this->errMessage = $e->getMessage();
            } 
        }

        // bind parameters to the query (if any)
        private function bindParameters() {
            if ($this->arrParams != null) { 
                $imax = sizeof($this->arrParams);
                for($i = 0; $i < $imax; $i++) {
                    $this->statement->bindParam(':'.$this->arrParams[$i][0], $this->arrParams[$i][1]);
                }
            }
        }

        // execute a query and catch error message (if any)
        private function executeQuery() {
            try {
                $this->statement->execute();
                return true;
            }
            catch (PDOException $e) {
                $this->errMessage = $e->getMessage();
                return false;
            }
        }

        // retrieve next row of the result set of a select query
        public function getNextRow() { return $this->statement->fetch(); }
        // retrieve all rows of the result set of a select query
        public function getAllRows() { return $this->statement->fetchAll(); }

        public function select($q='') {
            // reset error message
            $this->errMessage = '';

            if (empty($q) ) {
            // build query
            	$query = $this->buildSelectQuery();
            } else {
				$query = $q ;
			
			}

            // prepare query
            $this->prepareQuery($query);
            
            // bind parameters
            $this->bindParameters();

            //echo $query.'<br>'; // for debug purpose only

            // execute query
            return $this->executeQuery();
        }

    // INSERT
        private function buildInsertQuery() {
            $insert = "INSERT ";
            $into = "INTO ";
            $insertColumns = "";
            $insertValues = "";
            $maxInserting = sizeof($this->arrInserting);

            // nothing to insert
            if ($maxInserting == 0 || $this->tableForInsert == '') { return ''; }
            
            // into
            $into = $this->tableForInsert;

            // inserting
            for($i = 0; $i < $maxInserting; $i++) {
                $insertColumns .= $this->arrInserting[$i][0].',';
                $insertValues .= $this->arrInserting[$i][1].',';
            }
            $insertColumns = substr($insertColumns, 0, strlen($insertColumns)-1); // remove the last comma
            $insertValues = substr($insertValues, 0, strlen($insertValues)-1); // remove the last comma

            $query = $insert.$into.' ('.$insertColumns.' )'.' VALUES '.' ('.$insertValues.' )';
            return $query;
        }

        // retrieve the id of the last inserted row
        private function retrieveLastId() {
            $this->lastId = $this->connection->lastInsertId();
        }

        public function insert($q='') { // ajout de text sql 
            // reset error message
            $this->errMessage = '';

            if (empty($q) ) {
            // build query
            	$query = $this->buildInsertQuery();
            } else {
				$query = $q ;
			
			}
		
		/*        // build query       $query = $this->buildInsertQuery();*/

            // prepare query
            $this->prepareQuery($query);
            
            // bind parameters
            $this->bindParameters();

            //echo $query.'<br>'; // for debug purpose only
			$this->q = $query;
            // execute query
            $executed = $this->executeQuery();
            if ($executed) { $this->retrieveLastId(); }
            return $executed;
        }

    // UPDATE
        public function buildUpdateQuery() {
            $update = "UPDATE ";
            $updateColumnsValues = "";
            $maxUpdating = sizeof($this->arrUpdating);

            // nothing to update
            if ($maxUpdating == 0 || $this->tableToUpdate == '') { return ''; }
            
            // table to update
            $update .= $this->tableToUpdate;

            // updating
            for($i = 0; $i < $maxUpdating; $i++) {
                $updateColumnsValues .= $this->arrUpdating[$i][0].' = '.$this->arrUpdating[$i][1].',';
            }
            $updateColumnsValues = substr($updateColumnsValues, 0, strlen($updateColumnsValues)-1); // remove the last comma
            $w = (!empty($this->idToUpdate))?' WHERE '.$this->idToUpdate : '' ;
            $query = $update.' SET '.$updateColumnsValues.$w;
			
			$this->q = $query;
            return $query;
        }

        public function update() {
            // reset error message
            $this->errMessage = '';
            
            // build query
            $query = $this->buildUpdateQuery();

            // prepare query
            $this->prepareQuery($query);
            
            // bind parameters
            $this->bindParameters();

            //echo $query.'<br>'; // for debug purpose only

            // execute query
            $executed = $this->executeQuery();
            return $executed;
        }

    // DELETE
        private function buildDeleteQuery() {
            $delete = "DELETE FROM ";

            // nothing to delete
            if ($this->idToDelete == '' || $this->tableForDelete == '') { return ''; }
            
            // table to delete from
            $delete .= $this->tableForDelete;

            $query = $delete.' WHERE '.$this->idToDelete;
			$this->q = $query;
            return $query;
        }

        public function delete() {
            // reset error message
            $this->errMessage = '';
            
            // build query
            $query = $this->buildDeleteQuery();

            // prepare query
            $this->prepareQuery($query);
            
            // bind parameters
            $this->bindParameters();

            //echo $query.'<br>'; // for debug purpose only

            // execute query
            $executed = $this->executeQuery();
            return $executed;
        }
    }

?>