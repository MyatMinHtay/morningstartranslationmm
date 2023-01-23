<?php

namespace Core;


/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model extends Database
{

    protected function get_allowed_columns($data){
        
        if(!empty($this->allowed_columns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowed_columns)){
                    unset($data[$key]);
                }
            }
        }       
    
        

        return $data;
    
    }

    public function insert($data){

        $clean_array = $this->get_allowed_columns($data,$this->table);
    
        $keys = array_keys($clean_array);
    
        $query = "INSERT INTO $this->table";
        $query .= "(".implode(",",$keys) . ") VALUES ";
        $query .= "(:".implode(",:",$keys) . ")";
        // echo $query;
       
       
        $db = new Database;
        $result = $db->query($query,$clean_array);
        
    
        return $result;
         
         
      

    }

    public function update($id,$data,$idendify){

		$clean_array = $this->get_allowed_columns($data,$this->table);
		$keys = array_keys($clean_array);
		
        // "UPDATE TABLE SET id = 2, description = 'use' where id = $id";
		$query = "UPDATE $this->table SET ";

		foreach ($keys as $column) {
			// code...
			$query .= $column . "=:".$column .",";
		}

		$query = trim($query,",");
		$query .= " where $idendify = :$idendify";
		$clean_array[$idendify] = $id;
       
		$db = new Database; 
		$result = $db->query($query,$clean_array);	

        return $result;

	}

    public function delete($id,$idendify){

		$query = "delete from $this->table where $idendify = :$idendify";
		$clean_array[$idendify] = $id;

		$db = new Database;
		$db->query($query,$clean_array);	

	}
    
    public function where($data,$order_column = "id",$order = "desc"){
    
        
        // "select * from users where email = :email && password = :password";
    
        $keys = array_keys($data);
    
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key){
            $query .= "$key = :$key && ";
        }
        
        $query = trim($query," && ");
        // $query .= "ORDER BY  VoucherNo DESC";
        $query .= " ORDER BY $order_column $order";
        
    
        $db = new Database;
        return $db->search($query,$data);
    
    }

    public function getAll($order = "desc",$order_column = "id")
	{

		$query = "select * from $this->table order by $order_column $order";
  		
		$db = new Database;
		return $db->search($query);	

	}

    public function first($data){
    
        
       
    
        $keys = array_keys($data);
    
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key){
            $query .= "$key = :$key && ";
        }
        
        $query = trim($query," && ");
        // var_dump($query);
        $db = new Database;
        if($res = $db->search($query,$data)){
            return $res;
        }

        
        return false;
    }


}
