<?php
class welcome extends CI_Controller
	{
		function cab()
			{
				$this->load->view('welcome/header');
			}
		function index()
			{
				$this->cab();
				$this->load->view('welcome/wel01');
			}
	}
?>
