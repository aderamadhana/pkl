<?php

class M_siswa extends CI_Model
{

	// FUNCTION SELECT SEMUA DATA
	public function select($table)
	{
		return $this->db->get($table)->result();
	}

	public function pagination($table, $perPage, $offset)
	{
		return $this->db->get($table, $perPage, $offset)->result();
	}

	// FUNCTION UPDATE
	public function update($dimana, $data, $table)
	{
		$this->db->where($dimana);
		$this->db->update($table, $data);
	}

	// FUNCTION SELECT SATU DATA
	public function get_satu($table, $dimana)
	{
		return $this->db->get_where($table, $dimana)->result();
	}

	public function getPKLSiswa($table, $dimana)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('tb_tempat_rekomendasi', 'tb_tempat_rekomendasi.id_rekomendasi = tb_tempat_siswa.id_rekomendasi');
		$this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_tempat_siswa.id_siswa');
		$this->db->where('tb_tempat_siswa.id_siswa', $dimana);
		return $this->db->get()->result();
	}
	
	public function get_profile($dimana)
	{
		return $this->db->get_where('tb_siswa', $dimana)->result();
	}

	// FUNCTION INSERT BIASA

	public function tambah($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function satNot($dimana)
	{
		return $this->db->get_where('tb_notif', $dimana);
	}

	public function insert($data)
	{
		$this->db->insert('tb_absensi', $data);
		return $this->db->insert_id();
	}

	public function get_guru($tabel)
	{
		return $this->db->get($tabel)->result();
	}

	public function get_periode($tabel, $dimana)
	{
		return $this->db->get_where($tabel, $dimana)->result();
	}
}
