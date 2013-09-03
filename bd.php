<?php

class bd
{
	private $_database;

	public function __construct()
	{
		$this->connect();
	}

	public function connect()
	{
		$this->_database = mysql_connect('localhost','root','jramirezf');
		
		if($this->_database){
			if(!mysql_select_db('jlrb_db')){
				die('Error al conectar con la base de datos');
			}
		}
		return $this->_database;
	}

	public function num_rows($sql)
	{
		return mysql_num_rows($sql);
	}

	public function affected_rows($sql)
	{
		return mysql_affected_rows($sql);
	}

	public function fetch_array($result,$result_type=MYSQL_NUM)
	{
		return mysql_fetch_array($result,$result_type);
	}

	public function executeQuery($sql)
	{
		return mysql_query($sql);
	}

	public function disconnect()
	{
		mysql_close();
	}
}

?>