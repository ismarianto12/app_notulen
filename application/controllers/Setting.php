<?php 

/**
* @author  : Ismarianto Putra 
* @Created : At  7-31-2018
* @copyright :Ismarianto Putra
*/
class Setting extends CI_controller
{
  
  
  function __construct()
  {
    parent::__construct(); 
    include APPPATH.'third_party/font_awesome.php';
    login_access();
    $this->load->helper('file');
  }

  private function get_access($id_access){
    $this->db->select('*');
    $this->db->where('Locate("'.$param.'",level)');
    $this->db->from('menu');
    return $this->db->get();   
  }


  /*menu websiste*/
  function menu($action='',$id=''){
   if ($action == 'simpan') {

     $link = $_POST['link'];
     if($_POST['id'] != ''){
      $this->db->query("UPDATE menu SET nama_menu = '".$_POST['label']."', icon = '".$_POST['icon']."' , level = '".$_POST['level']."' ,link  = '".$link."' where id_menu = '".$_POST['id']."' ");
      $arr['type']  = 'edit';
      $arr['label'] = $_POST['label'];
      $arr['link']  = $_POST['link'];
      $arr['level'] = $_POST['level'];
      $arr['id']    = $_POST['id'];
    }else{
      $row = $this->db->query("SELECT max(urutan)+1 as urutan FROM menu")->row_array();
      if ($row['urutan'] == 0) {
       $id_urut = 1;

     }else{
      $id_urut = $row['urutan'];
    }
        // $this->db->query("INSERT into menu VALUES('','0','".$_POST['label']."', '".$link."','Ya','Bottom','".$row['urutan']."')");
    $icon = ($this->input->post('icon')) ? $_POST['icon'] : 'icon-list fa-fw';
    $insert = [
      'id_parent'=>'0',
      'nama_menu'=>$this->input->post('label'),
      'icon'=>$icon,
      'link'=>$this->input->post('link'),
      'level'=>$this->input->post('level'),
      'aktif'=>'Ya',
      'position'=>'Bottom',
      'urutan'=>$id_urut,
    ];
    $this->db->insert('menu',$insert);
    $id = $this->db->insert_id();

    $arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$id.'" >
    <div class="dd-handle dd3-handle Bottom"></div>
    <div class="dd3-content"><span id="label_show'.$id.'">'.$_POST['label'].'</span>
    <span class="span-right">/<span id="link_show'.$id.'">'.$link.'</span> &nbsp;&nbsp; 
    <a href="'.base_url($this->uri->segment(1).'/posisi_menu/'.$id).'" style="cursor:pointer"><i class="fa fa-chevron-circle-up text-success"></i></a> &nbsp; 
    <a class="edit-button" id="'.$id.'" label="'.$_POST['label'].'" link="'.$_POST['link'].'" ><i class="fa fa-pencil"></i></a> &nbsp; 
    <a class="del-button" id="'.$id.'"><i class="fa fa-trash"></i></a>
    </span> 
    </div>';
    $arr['type'] = 'add';
  }
  print json_encode($arr);  
}elseif($action  == 'save_position'){
  $data = json_decode($_POST['data']);
  function parseJsonArray($jsonArray, $parentID = 0) {
    $return = array();
    foreach ($jsonArray as $subArray) {
      $returnSubSubArray = array();
      if (isset($subArray->children)) {
        $returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
      }

      $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
      $return = array_merge($return, $returnSubSubArray);
    }
    return $return;
  }
  $readbleArray = parseJsonArray($data);

  $i=0;
  foreach($readbleArray as $row){
    $i++;
    $this->db->query("UPDATE menu SET id_parent = '".$row['parentID']."', urutan = '".$i."' where id_menu = '".$row['id']."' ");
  }

}elseif($action == 'kategori'){
  $cek = $this->db->get_where('menu',array('id_menu'=>$this->uri->segment(3)))->row_array();
  $posisi = ($cek['position'] == 'Top' ? 'Bottom' : 'Top');
  $data = array('position'=>$posisi);
  $where = array('id_menu' => $this->uri->segment(3));
  $this->db->update('menu', $data, $where);
  redirect($this->uri->segment(1).'/menu');


}elseif($action == 'delete'){

  
  $idm = array('id_menu' => $this->input->post('id'));
  $this->db->delete('menu',$idm);
  $idm = array('id_parent' => $this->input->post('id'));
  $this->db->delete('menu',$idm);

}else{
  
  $x['icon']  = jt_get_font_icons();  
  $x['judul'] = "Menu dan hak akses";
  $x['record'] =$this->db->order_by('urutan')->get('menu');
  $this->template->load('template','menu_app',$x);
}
}

}