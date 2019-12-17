<?php 
class Profile extends CI_controller
{ 
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{ 
		$row = $this->db->get_where('login',array('id_user'=>$this->session->id_user))->row();
		$x =array('judul' =>'Edit Profile',
			'id_user' =>$row->id_user,
			'username' =>$row->username,
			'password' =>$row->password,
			'nama' =>$row->nama,
			'level' =>$row->level,
			'foto' =>$row->foto,
			'email' =>$row->email, 
			'active' =>$row->active, 
		);
		$this->template->load('template','profil',$x);
	}
	function action_insert(){
		if ($_SERVER['REQUEST_METHOD'] == "POST") { 
			if ($_FILES['foto']['name'] !='') { 
				$conf['file_name'] = 'foto'.time();
				$conf['upload_path'] = 'assets/img/foto';
				$conf['allowed_types']  = 'jpg|png|bmp';

				$this->upload->initialize($conf);
				if($this->upload->do_upload('foto') == TRUE){ 

					$qdata = $this->db->get_where('login',array('id_user'=>$this->input->post('id_user')));
					$cek_id = $qdata->row_array();
					unlink('assets/img/foto/'.$cek_id['foto']);
					$data = array(
						'username' => $this->input->post('username',TRUE),
						'password' => md5($this->input->post('password',TRUE)),
						'nama' => $this->input->post('nama',TRUE),
						'level' => $this->input->post('level',TRUE),
						'email' => $this->input->post('email',TRUE),
						'foto' => $this->upload->file_name, 
						'log' => date('Y-m-d H:i:s'),
						'active' => 'Y',
					); 
					$this->db->update('login',$data,array('id_user'=>$this->session->id_user));
					$this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
					redirect(site_url('login'));

				}else{
					$this->session->set_flashdata('message',$this->upload->dislplay_errors('<div class="callout callout-danger">','</div>'));
					redirect(base_url('login'));
				}
			}else{
				$data = array(
					'username' => $this->input->post('username',TRUE),
					'password' => $this->input->post('password',TRUE),
					'nama' => $this->input->post('nama',TRUE),
					'level' => $this->input->post('level',TRUE),
					'email' => $this->input->post('email',TRUE), 
					'log' => date('Y-m-d H:i:s'),
					'active' => 'Y',
				);

			    $this->db->update('login',$data,array('id_user'=>$this->session->id_user));
			}
		}
	}		

	public function _rules() 
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('level', 'level', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required'); 
		$this->form_validation->set_rules('active', 'active', 'trim|required'); 
		$this->form_validation->set_rules('id_user', 'id_user', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}