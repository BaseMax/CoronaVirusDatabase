<?php
/**
 *
 * @Name : phpedb.php
 * @Version : 1.1
 * @Programmer : Max
 * @Date : 2016-2019, 2019-07-10, 2020-02-26, 2020-02-27
 * @Released under : https://github.com/BaseMax/PHPEDB/blob/master/LICENSE
 * @Repository : https://github.com/BaseMax/PHPEDB
 *
 **/
class database
{
	public $database=null;
	public $db="";
	private function error_page($error)
	{
		exit("<meta charset=\"utf-8\"><br><br><center><h1>Error : ".$error."</h1></center>");
	}
	public function connect($host="localhost",$user="root",$pass="")
	{
		try
		{
			$this->database=new PDO("mysql:host=$host;",$user,$pass);
			$this->database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->database->query('SET NAMES '.'utf8mb4');
		}
		catch(PDOException $e)
		{
			$this->database=null;
			$this->error_page($e->getMessage());
		}
	}
	public function check()
	{
		if($this->database == null)
		{
			return false;
		}
		return true;
	}
	public function disconnect()
	{
		$this->database=null;
	}
	public function selectRaw($query)
	{
		try
		{
			$stmt = $this->database->prepare($query);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function selectsRaw($query)
	{
		try
		{
			$stmt = $this->database->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function query($query,$error=true)
	{
		try
		{
			$this->database->exec($query);
		}
		catch(PDOException $e)
		{
			if($error == true)
			{
				$this->error_page($e->getMessage());
			}
		}
	}
	public function create_database($name,$error=true)
	{
		try
		{
			$this->query("CREATE DATABASE ".$name." CHARACTER Set utf8 COLLATE utf8_general_ci;",$error);
		}
		catch(PDOException $e)
		{
			if($error == true)
			{
				$this->error_page($e->getMessage());
			}
		}
	}
	public function selects($table,$clause=[],$after="",$__sql="")
	{
		try
		{
			$sql = "SELECT * FROM `".$this->db."`.`".$table."` ";
			$current=0;
			$count=count($clause);
			if(count($clause) > 0)
			{
				$sql.=" WHERE ";
				foreach($clause as $name=>$value)
				{
					$operator="=";
					$do="and";
					if(is_array($value))
					{
						$operator=$value[0];
						$do=$value[1];
						$value=$value[2];
					}
					$sql.=$name . " ". $operator ." ? ";
					if($current != $count-1)
					{
						$sql.=" ".$do." ";
					}
					$current++;
				}
			}
			$sql.=" ". $after." ";
			$sql.=";";
			if(trim($__sql) !="")
			{
				$sql=$__sql;
			}
			// print $sql."\n";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($clause) > 0)
			{
				foreach($clause as $name=>$value)
				{
					if(is_array($value))
					{
						$value=$value[2];
					}
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
			//return $stmt->fetchAll();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function select($table,$clause=[],$after="")
	{
		try
		{
			$sql = "SELECT * FROM `".$this->db."`.`".$table."` ";
			$current=0;
			$count=count($clause);
			if(count($clause) > 0)
			{
				$sql.=" WHERE ";
				foreach($clause as $name=>$value)
				{
					$operator="=";
					$do="and";
					if(is_array($value))
					{
						$operator=$value[0];
						$do=$value[1];
						$value=$value[2];
					}
					$sql.=$name . " ". $operator ." ? ";
					if($current != $count-1)
					{
						$sql.=" ".$do." ";
					}
					$current++;
				}
			}
			$sql.=" ". $after." ";
			$sql.=";";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($clause) > 0)
			{
				foreach($clause as $name=>$value)
				{
					if(is_array($value))
					{
						$value=$value[2];
					}
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function sum($table, $column, $clause=[]) {
		try
		{
			$sql = "select SUM(".$column.") FROM `".$this->db."`.`".$table."` ";
			$current=0;
			$count=count($clause);
			if(count($clause) > 0)
			{
				$sql.=" WHERE ";
				foreach($clause as $name=>$value)
				{
					$operator="=";
					$do="and";
					if(is_array($value))
					{
						$operator=$value[0];
						$do=$value[1];
						$value=$value[2];
					}
					$sql.=$name . " ". $operator ." ? ";
					if($current != $count-1)
					{
						$sql.=" ".$do." ";
					}
					$current++;
				}
			}
			$sql.=";";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($clause) > 0)
			{
				foreach($clause as $name=>$value)
				{
					if(is_array($value))
					{
						$value=$value[2];
					}
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
			return $stmt->fetchColumn(0);
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function count($table,$clause=[])
	{
		try
		{
			$sql = "select count(*) FROM `".$this->db."`.`".$table."` ";
			$current=0;
			$count=count($clause);
			if(count($clause) > 0)
			{
				$sql.=" WHERE ";
				foreach($clause as $name=>$value)
				{
					$operator="=";
					$do="and";
					if(is_array($value))
					{
						$operator=$value[0];
						$do=$value[1];
						$value=$value[2];
					}
					$sql.=$name . " ". $operator ." ? ";
					if($current != $count-1)
					{
						$sql.=" ".$do." ";
					}
					$current++;
				}
			}
			$sql.=";";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($clause) > 0)
			{
				foreach($clause as $name=>$value)
				{
					if(is_array($value))
					{
						$value=$value[2];
					}
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
			return $stmt->fetchColumn(0);
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function delete($table,$clause=[])
	{
		try
		{
			$sql = "DELETE FROM `".$this->db."`.`".$table."` ";
			$current=0;
			$count=count($clause);
			if(count($clause) > 0)
			{
				$sql.=" WHERE ";
				foreach($clause as $name=>$value)
				{
					$operator="=";
					$do="and";
					if(is_array($value))
					{
						$operator=$value[0];
						$do=$value[1];
						$value=$value[2];
					}
					$sql.=$name . " ". $operator ." ? ";
					if($current != $count-1)
					{
						$sql.=" ".$do." ";
					}
					$current++;
				}
			}
			$sql.=";";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($clause) > 0)
			{
				foreach($clause as $name=>$value)
				{
					if(is_array($value))
					{
						$value=$value[2];
					}
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function insert($table,$values)
	{
		try
		{
			$sql = "INSERT INTO `".$this->db."`.`".$table."`(";
			$sql_values="";
			$current=0;
			$count=count($values);
			if(count($values) > 0)
			{
				foreach($values as $name=>$value)
				{
					$sql.=$name;
					$sql_values.=" ? ";
					if($current != $count-1){$sql.=",";$sql_values.=",";}
					$current++;
				}
			}
			$sql.=") VALUES (";
			$sql.=$sql_values;
			$sql.=");";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($values) > 0)
			{
				foreach($values as $name=>$value)
				{
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
			return $this->database->lastInsertId();
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
	public function update($table,$clause,$values)
	{
		try
		{
			$sql = "UPDATE `".$this->db."`.`".$table."` SET ";
			$current=0;
			$count=count($values);
			if(count($values) > 0)
			{
				foreach($values as $name=>$value)
				{
					$sql.=$name . " = " . " ? ";
					if($current != $count-1){$sql.=",";}
					$current++;
				}
			}
			$sql.=" ";
			$current=0;
			$count=count($clause);
			if(count($clause) > 0)
			{
				$sql.=" WHERE ";
				foreach($clause as $name=>$value)
				{
					$operator="=";
					$do="and";
					if(is_array($value))
					{
						$operator=$value[0];
						$do=$value[1];
						$value=$value[2];
					}
					$sql.=$name . " ". $operator ." ? ";
					if($current != $count-1)
					{
						$sql.=" ".$do." ";
					}
					$current++;
				}
			}
			$sql.=";";
			$stmt = $this->database->prepare($sql);
			$current_all=1;
			if(count($values) > 0)
			{
				foreach($values as $name=>$value)
				{
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			if(count($clause) > 0)
			{
				foreach($clause as $name=>$value)
				{
					if(is_array($value))
					{
						$value=$value[2];
					}
					$stmt->bindValue($current_all,$value,PDO::PARAM_STR);
					$current_all++;
				}
			}
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			$this->error_page($e->getMessage());
		}
	}
}
