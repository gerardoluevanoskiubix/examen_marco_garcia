<?php

class UserModel extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    public function insert($data) {
        return $this->db->insert('user', $data);
    }

    public function get_all_users(){
        $query = $this->db->get('user');
        return $query->result_array(); //Devuelve los resultados en forma de array
    }

    public function update($id, $data){
        $this->db->where('ID', $id);
        return $this->db->update('user', $data);
    }

    public function get($id) {
        $query = $this->db->get_where('user', array('ID' => $id));
        return $query->row_array(); // Devuelve un solo registro como un array asociativo
    }

    public function delete($id){
        $this->db->where('ID', $id);
        return $this->db->delete('user');
    }
    
}