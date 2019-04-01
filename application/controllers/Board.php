<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Board_model', 'Board_m', TRUE); 
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('home');
	}

	public function about()
	{
		$this->load->view('templates/header');
		$this->load->view('about'); 
	}

	public function posts()
	{
		$this->load->view('templates/header'); 
		$this->load->view('posts'); 
	}
	public function get_board()
	{
		$result = ''; 
		$board = $this->Board_m->get_board(); 
		if(count($board)>0)
		{
			foreach($board as $post){
				$result .= '<tr id="row-id-'.$post->board_id.'">';
                $result .= '<td>'.$post->board_id.'</td>';
                $result .= '<td>'.$post->title.'</td>';
                $result .= '<td>'.$post->dpt_name.'</td>';
                $result .= '<td>'.$post->user_name.'</td>';
                $result .= '<td>'.$post->created.'</td>';
                $result .= '<td>'; 
                $result .= '<a href="#" class="btn-confirm-show" dataid="'.$post->board_id.'"><i class="fa fa-eye" data-toggle="tooltip" title="Show post"></i></a> |';
                $result .= '<a href="#" class="btn-confirm-update" dataid="'.$post->board_id.'"><i class="fa fa-edit" data-toggle="tooltip" title="Edit post"></i></a> |';
                $result .= '<a href="#" class="btn-confirm-delete" dataid="'.$post->board_id.'"><i class="fa fa-trash" data-toggle="tooltip" title="Delete post"></i></a>';
                $result .= '</td>';
                $result .= '</tr>';
        	}
		} else{
			$result='<tr>none</tr>'; 
		}
		echo json_encode($result);
	}
	public function create_post()
	{
		$data = array(
			'title'		=> $this->input->post('title'), 
			'content'	=> $this->input->post('content'),
			'user_id'	=>$this->input->post('user_id')
		);
		$post = $this->Board_m->create_post_query($data); 

		if($post)
		{
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('success'=>false));
		}
	}
	public function delete_post()
	{
		$board_id=$this->input->post('board_id');
		$remove=$this->Board_m->delete_post_query($board_id);
		// ajax must send something from controller 
		if($board_id){
			echo "1"; 
		}
		else {
			echo "0";
		}
	}
	public function get_update_post()
	{	
		$result=''; 
		$board_id=$this->input->post('board_id');
		$board = $this->Board_m->get_update_post_query($board_id);
		$user_id=$this->Board_m->get_writer_id_query($board_id); 
		$result_array= array();
		if(count($board)>0)
		{
			foreach($board as $post)
			{
				$result .= '<div class="form-group">';
				$result .= '<label class="control-label col-sm-2" for="title">Title:</label>';
				$result .= '<div class="col-sm-12">';
				$result .= '<input type="text" class="form-control" id="title" name="val[title]" value="'.$post->title.'">';
				$result .= '<input type="hidden" name=board_id value="'.$post->board_id.'">';
				$result .= '</div>';
				$result .= '</div>';
				$result .= '<div class="form-group">';
				$result .= '<label class="control-label col-sm-2" for="cate_desc">Content:</label>';
				$result .= '<div class="col-sm-12">';
				$result .= '<textarea class="form-control" id="content" name="val[content]">'.$post->content.'</textarea>';
				$result .= '</div>';
				$result .= '</div>';
				$user_id = $post->user_id; 
			}

			$result_array[0] = $result; 
			$result_array[1] = $user_id; 
			echo json_encode($result_array); 
		}
	}
	public function update_post()
	{
		$data=array(); 
		$board_id=$this->input->post('board_id'); 
		$data=$this->input->post('val'); 
		$update_post=$this->Board_m->update_post_query($board_id, $data);
		if($update_post){
			echo "1"; 
		}
		else {
			echo "0";
		}
	}
}
