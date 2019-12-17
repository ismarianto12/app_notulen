<?php 

class Dasboard_model extends CI_model{
	

	function grafik_by_agenda(){
       $this->db->select(' 
           a.id_notulen,
           a.agenda,
           a.id_create,
           a.start_time,
           a.end_time,
           a.place,
           a.participan,
           a.date_create,

           b.id_user,
           b.nama,
           b.email,
           b.level,
           b.active,
           b.date_create,
           b.log, 
 
           c.id_not_detail,
           c.id_notulen,
           c.issue,
           c.PIC,
           c.due_dete,
           sum(c.status = "Y") as closed,
           sum(c.status = "N") as open, 
           c.remarks,
           c.date_created');

        $this->db->from('notulen_detail c'); 
        $this->db->join('notulen a', 'a.id_notulen=c.id_notulen','left');
        $this->db->join('login b', 'a.id_create = b.id_user','left'); 
        $this->db->group_by('c.date_created');
        return $this->db->get();   
	} 


}