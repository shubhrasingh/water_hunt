<?php
class Admin_model extends CI_Model {

      
        public function getData($tbl)
        {
			    $tbl=$this->db->dbprefix.$tbl;
                $query = $this->db->get($tbl);
                return $query->result();
        }
		
		public function getWhere($tbl,$where)
		{
		  $tbl=$this->db->dbprefix.$tbl;
		  $query = $this->db->get_where($tbl,$where);
		  return $query->result();
		}
		
		public function getwithLimitOrderBy($tbl,$where,$end_limit,$start_limit,$col,$order)
		{
		  $tbl=$this->db->dbprefix.$tbl;
		  $this->db->order_by($col, $order);
		  $query = $this->db->get_where($tbl,$where,$end_limit,$start_limit); 
		  return $query->result();
		}

		public function getwithLimit($tbl,$where,$end_limit,$start_limit)
		{
		  $tbl=$this->db->dbprefix.$tbl;
		  $query = $this->db->get_where($tbl,$where,$end_limit,$start_limit); 
		  return $query->result();
		}

		public function getwithOrderBy($tbl,$where,$col,$order)
		{
		  $tbl=$this->db->dbprefix.$tbl;
		  $this->db->order_by($col, $order);
		  $query = $this->db->get_where($tbl,$where); 
		  return $query->result();
		}

		public function updateData($tbl,$data,$id)
		{
			$tbl=$this->db->dbprefix.$tbl;
			$this->db->where('id', $id);
            $this->db->update($tbl, $data);
		}
		
		public function insertData($tbl,$data)
		{
			$tbl=$this->db->dbprefix.$tbl;
            $this->db->insert($tbl, $data);
			$lid=$this->db->insert_id();
			return $lid;
		}
		
		public function deleteData($tbl,$where)
		{
			$tbl=$this->db->dbprefix.$tbl;
			$this->db->delete($tbl,$where); 
		}
		
		
		public function getQuery($sql)
		{
			$query = $this->db->query($sql);
            return $query->result();
		}
		
		public function updateCompanyprofile($data)
		{
			$tbl=$this->db->dbprefix.'master_admin';
            $this->db->update($tbl , $data);
		}
		
		public function updateTestSetting($data)
		{
			$tbl=$this->db->dbprefix.'test_setting';
            $this->db->update($tbl , $data);
		}
		
		public function updateWhere($tbl,$data,$where)
		{
			$tbl=$this->db->dbprefix.$tbl;
            $this->db->update($tbl, $data, $where);
		}
		
		public function getDataCount($tbl,$where)
		{
		  $tbl=$this->db->dbprefix.$tbl;
		  $query = $this->db->get_where($tbl,$where);
		  return $query->num_rows();
		}

	
}
?>