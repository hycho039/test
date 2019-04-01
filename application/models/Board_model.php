<?php 

class Board_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	public function get_board()
	{
		$sql="select board_id, title, content, user_name, department.name as dpt_name, 
			  date(created) as created 
			  from board, users, department 
			  where board.user_id = users.user_id and users.department_id = department.department_id";
		$query = $this->db->query($sql); 
		return $query->result(); 
	}
	public function create_post_query($data)
	{
		$this->db->insert('board', $data); 
		return $insert_id = $this->db->insert_id(); 
	}
	public function delete_post_query($id)
	{
		$this->db->where('board_id', $id); 
		return $this->db->delete('board');
	}
	public function get_update_post_query($id)
	{
		$sql="select board_id, title, content, user_id from board where board_id=".$id.';';
		$query = $this->db->query($sql); 
		return $query->result(); 
	}
	public function update_post_query($id, $data)
	{
		$this->db->where('board_id', $id); 
		return $this->db->update('board', $data);
	}
	public function get_writer_id_query($id)
	{
		$sql="select user_id from board where board_id=".$id.';';
		$query = $this->db->query($sql); 
		return $query->result();
	}
}