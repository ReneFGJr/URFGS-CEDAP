<?php
class Authority extends CI_controller
	{
		function cab()
			{
				$data = array();
				$data['title'] = 'Authority Controle :: v0.03';
				$data['js'] = array();
				$data['css'] = array();
				$this->load->view('FRBR/header',$data);
				$this->load->view('FRBR/menu_top',$data);
			}
		function index()
			{
				$this->load->model('frbr');
				
				$this->cab();
				$this->load->view('FRBR/search');
				$term = get("search");
				$type = get("entidade");
				
				if (strlen($term) > 0)
					{
						$this->frbr->register_search($term,$type);
						
						$data['content'] = $this->frbr->consulta_person($term);
						$data['title'] = '';
						$this->load->view('content',$data);
					}
			}
			
		function import()
			{
				$this->load->model('frbr');
				
				$this->cab();
				
				$form = new form;
				$cp = array();
				array_push($cp,array('$H8','','',False,True));
				array_push($cp,array('$T80:14','','MARC21',True,True));
				array_push($cp,array('$B8','','Inport',False,True));
				$data['content'] = $form->editar($cp,'');
				$data['title'] = 'Inport MARC21 - Authority Control';
				$this->load->view('content',$data);
				
				if ($form->saved > 0)
					{
						$txt = get("dd1");
						$data['content'] = '<pre>'.$txt.'</pre>';
						$data['title'] = '';
						$this->load->view('content',$data);
						
						$data['content'] = $this->frbr->inport_marc21($txt);
						$this->load->view('content',$data);
					}
			}
					
			
		function author($id)
			{
				$this->load->model('frbr');
				
				$this->cab();
				
				if (round($id) > 0)
					{
						$data = $this->frbr->le_person($id);
						
						$data['content'] = $this->load->view('frbr/frad/details',$data,true);
						$data['title'] = '';
						$this->load->view('content',$data);
					}
			}			
	}
