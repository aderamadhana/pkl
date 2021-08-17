<?php

class m_guru extends CI_Model
{
    // Function cari
    public function fullget($key, $perPage, $offset)
    {
        if ($key != "") {
            return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi=tb_tempat_siswa.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru WHERE tb_guru.user = '".$this->session->userdata('guru')."' AND nama_siswa LIKE '%" . $key . "%' ")->result();
        } else {
            return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa JOIN tb_tempat_rekomendasi ON tb_tempat_rekomendasi.id_rekomendasi=tb_tempat_siswa.id_rekomendasi JOIN tb_guru ON tb_guru.id_guru = tb_tempat_siswa.id_guru WHERE tb_guru.user = '".$this->session->userdata('guru')."' ORDER BY jurusan ASC LIMIT $offset, $perPage ")->result();
        }
    }

    public function getKomen($dimana)
    {
        return $this->db->get_where('tb_tempat_siswa', $dimana)->result();
    }
    // FUNCTION TAMBAH DATA

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function cari($key)
    {
        if ($key != "") {
            return $this->db->query("SELECT * FROM tb_tempat_siswa INNER JOIN tb_siswa ON tb_tempat_siswa.id_siswa = tb_siswa.id_siswa WHERE nama_siswa LIKE '%" . $key . "%' ")->result();
        }
    }

    public function ambil_kegiatan($query, $perPage, $offset){
		if ($query != "") {
			$oke = $this->db->query("SELECT * FROM tb_kegiatan_view WHERE user_guru = '".$this->session->userdata('guru')."' AND nama_siswa LIKE '%" . $query . "%' group by id_siswa");
		} else {
			$oke = $this->db->query("SELECT * FROM tb_kegiatan_view WHERE user_guru = '".$this->session->userdata('guru')."' group by id_siswa");
		}
		return $oke->result();
	}

	public function ambil_detail_kegiatan($id_siswa){
		return $this->db->get_where('tb_kegiatan_view', array('id_siswa' => $id_siswa))->result();
	}

    public function updateNilai($data, $where){
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('tb_nilai');
	}
}
