<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/restoran-padang/'
        ]);
    }

    public function getAllRestoran()
    {

        $response = $this->_client->request('GET', 'Menu_makan');

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['message'];
    }

    public function getRestoranId($id)
    {
        $response = $this->_client->request('GET', 'Menu_makan', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['message'][$id];
    }

    public function tambahRestoran()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "gambar" => $this->input->post('gambar', true),
            "harga" => $this->input->post('harga', true)
        ];

        $response = $this->_client->request('POST', 'Menu_makan', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function hapusRestoran($nama)
    {
        $response = $this->_client->delete('Menu_makan', [
            'form_params' => [
                'nama' => $nama,
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataRestoran()
    {
        $data = [
            "id" => $this->input->post('id', true),
            "nama" => $this->input->post('nama', true),
            "gambar" => $this->input->post('gambar', true),
            "harga" => $this->input->post('harga', true),

        ];

        $response = $this->_client->request('PUT', 'Menu_makan', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        // $keyword = $this->input->post('keyword', true);
        // $this->db->like('nama', $keyword);
        // $this->db->or_like('gambar', $keyword);
        // $this->db->or_like('harga', $keyword);
        // return $this->db->get('mahasiswa')->result_array();
        return false;
    }
}
