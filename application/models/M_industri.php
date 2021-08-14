<?php

class m_industri extends CI_Model
{
    // START FUNCTION NOTIF 
	public function allNotif($perPage, $offset)
	{
		$this->db->select('*');
		$this->db->from('tb_siswa');
		$this->db->join('tb_sementara', 'tb_siswa.id_siswa = tb_sementara.id_siswa');
		$this->db->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_sementara.id_rekomendasi');
		$this->db->join('tb_guru', 'tb_guru.id_guru = tb_sementara.id_guru');
		$this->db->join('tb_periode', 'tb_periode.id_periode = tb_sementara.id_periode');
		$this->db->where('tb_tempat_rekomendasi.user', $this->session->userdata('industri'));
        $this->db->where('status_pkl', 1);
		return $this->db->get();
	}

    public function get_satu($id_siswa)
	{
		$this->db->select('*');
		$this->db->from('tb_sementara');
		$this->db->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_sementara.id_rekomendasi');
		$this->db->join('tb_guru', 'tb_guru.id_guru = tb_sementara.id_guru');
		$this->db->join('tb_periode', 'tb_periode.id_periode = tb_sementara.id_periode');
        $this->db->where('tb_sementara.id_siswa', $id_siswa);
        return $this->db->get()->result();
	}

	public function ambil_cari($query, $perPage, $offset)
	{
		if ($query != "") {
			$oke = $this->db->query("SELECT tb_siswa.* FROM tb_tempat_siswa JOIN tb_siswa ON tb_siswa.id_siswa = tb_tempat_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi WHERE tb_tempat_rekomendasi.user = '".$this->session->userdata('industri')."' AND nama_siswa LIKE '%" . $query . "%' ");
		} else {
			$oke = $this->db->query("SELECT tb_siswa.* FROM tb_tempat_siswa JOIN tb_siswa ON tb_siswa.id_siswa = tb_tempat_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi WHERE tb_tempat_rekomendasi.user = '".$this->session->userdata('industri')."'");
		}

		return $oke->result();
	}
}