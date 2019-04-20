<?php
class Model extends CI_Model {
	
	public function check_table()
	{
		if ($this->db->table_exists('backup') )
		{
		  	  $this->db->select('*');
		      $this->db->from('backup');
		      $this->db->where('MONTH(added_on)', date('m')); //For current month
		      $this->db->where('YEAR(added_on)', date('Y')); // For current year
		    
		      $query = $this->db->get();
		      if($query->num_rows()>0){
		      		return 0;
		      }
		      else{
		      	$this->db->insert('backup',array('added_on'=>date('Y-m-d H:i:s')));
			  	return 1;
		      }
		}
		else
		{
		  	$sql = "CREATE TABLE backup (
			  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 			 
			  added_on TIMESTAMP
			  )";
			  $query = $this->db->query($sql);
			  $this->db->insert('backup',array('added_on'=>date('Y-m-d H:i:s')));
			  return 1;
		}
	}
}
