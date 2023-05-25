<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MahasiswaController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function add()
    {
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();

        $data = [
            'prodi_mahasiswa' => $this->request->getPost('prodi_mahasiswa'),
            'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
            'nim_mahasiswa' => $this->request->getPost('nim_mahasiswa'),
            'image_mahasiswa' => $fileName,
        ];

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image_mahasiswa' => 'uploaded[file]|max_size[file,1024]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => $validation->getErrors()
            ]);
        } else {
            $file->move('uploads/avatar', $fileName);
            $model = new \App\Models\MahasiswaModel();
            $model->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Tambah data Mahasiswa sukses!'
            ]);
        }
    }

    public function fetch()
    {
        $model = new \App\Models\MahasiswaModel();
        $mahasiswa = $model->getJoinedMahasiswa();
        $data = '';

        if ($mahasiswa) {
            $data = '<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" width="20%">Foto</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($mahasiswa as $index => $value) {
                $data .= '
                <tr>
                    <td>' . ($index + 1) . '</td>
                    <td><img style="max-width: 120px;" src="uploads/avatar/' .  $value['image_mahasiswa'] . '"></td>
                    <td>' . $value['nim_mahasiswa'] . '</td>
                    <td>' . $value['nama_mahasiswa'] . '</td>
                    <td>' . $value['nama_prodi'] . '</td>
                    
                    <td>
                        <a href="#" id=' . $value['id_mahasiswa'] . ' data-bs-toggle="modal" data-bs-target="#edit_mahasiswa_modal" class="btn btn-success btn-sm mahasiswa_edit_btn">Rubah</a>
                        <a href="#" id=' . $value['id_mahasiswa'] . ' class="btn btn-danger btn-sm mahasiswa_delete_btn">Hapus</a>
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

    public function fetchOption()
    {
        $model = new \App\Models\ProdiModel();
        $prodi = $model->findAll();
        $data = '';

        if ($prodi) {
            foreach ($prodi as $index => $value) {
                $data .= '<option value="' . $value['id_prodi'] . '">' . $value['nama_prodi'] . '</option>';
            }

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
        $model = new \App\Models\MahasiswaModel();
        $mahasiswa = $model->find($id);
        return $this->response->setJSON([
            'error' => false,
            'message' => $mahasiswa
        ]);
    }

    public function update()
    {
        $id_mahasiswa = $this->request->getPost('id_mahasiswa');
        $file = $this->request->getFile('file');
        $fileName = $file->getFilename();

        if ($fileName != '') {
            $fileName = $file->getRandomName();
            $file->move('uploads/avatar', $fileName);
            if ($this->request->getPost('old_image_mahasiswa') != '') {
                unlink('uploads/avatar/' . $this->request->getPost('old_image_mahasiswa'));
            }
        } else {
            $fileName = $this->request->getPost('old_image_mahasiswa');
        }

        $data = [
            'prodi_mahasiswa' => $this->request->getPost('prodi_mahasiswa'),
            'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
            'nim_mahasiswa' => $this->request->getPost('nim_mahasiswa'),
            'image_mahasiswa' => $fileName,
        ];

        $model = new \App\Models\MahasiswaModel();
        $model->update($id_mahasiswa, $data);
        return $this->response->setJSON([
            'error' => false,
            'message' => 'Data mahasiswa berhasil diperbarui!'
        ]);
    }

    public function delete($id = null)
    {
        $model = new \App\Models\MahasiswaModel();
        $mahasiswa = $model->find($id);
        $model->delete($id);
        unlink('uploads/avatar/' . $mahasiswa['image_mahasiswa']);

        return $this->response->setJSON([
            'error' => false,
            'message' => 'Data mahasiswa berhasil dihapus!'
        ]);
    }
}
