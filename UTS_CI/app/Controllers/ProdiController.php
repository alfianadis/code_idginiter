<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProdiController extends BaseController
{
    public function index()
    {
        return view('prodi/index');
    }

    public function add()
    {
        $data = [
            'nama_prodi' => $this->request->getPost('nama_prodi'),
        ];

        $model = new \App\Models\ProdiModel();
        $model->save($data);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Tambah data Prodi sukses!'
        ]);
    }

    public function fetch()
    {
        $model = new \App\Models\ProdiModel();
        $prodi = $model->findAll();
        $data = '';

        if ($prodi) {
            $data = '<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($prodi as $index => $value) {
                $data .= '
                <tr>
                    <td>' . ($index + 1) . '</td>
                    <td>' . $value['nama_prodi'] . '</td>
                    <td>
                        <a href="#" id=' . $value['id_prodi'] . ' data-bs-toggle="modal" data-bs-target="#edit_prodi_modal" class="btn btn-success btn-sm prodi_edit_btn">Rubah</a>
                        <a href="#" id=' . $value['id_prodi'] . ' class="btn btn-danger btn-sm prodi_delete_btn">Hapus</a>
                    </td>
                </tr>';
            }

            $data .= '</tbody>
                    </table>';

            return $this->response->setJSON([
                'error' => false,
                'message' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'error' => false,
                'message' => '<div class="text-secondary text-center fw-bold my-5">Data Loading..</div>'
            ]);
        }
    }

    public function edit($id = null)
    {
        $model = new \App\Models\ProdiModel();
        $prodi = $model->find($id);
        return $this->response->setJSON([
            'error' => false,
            'message' => $prodi
        ]);
    }

    public function update()
    {
        $id_prodi = $this->request->getPost('id_prodi');

        $data = [
            'nama_prodi' => $this->request->getPost('nama_prodi'),
        ];

        $model = new \App\Models\ProdiModel();
        $model->update($id_prodi, $data);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Data Prodi berhasil diperbarui!'
        ]);
    }

    public function delete($id = null)
    {
        $model = new \App\Models\ProdiModel();
        $model->delete($id);

        return $this->response->setJSON([
            'error' => false,
            'message' => 'Data Prodi berhasil dihapus!'
        ]);
    }
}
