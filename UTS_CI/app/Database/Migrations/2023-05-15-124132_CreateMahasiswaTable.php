<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMahasiswaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'prodi_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama_mahasiswa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nim_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 255,
            ],
            'image_mahasiswa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id_mahasiswa', true);
        $this->forge->addForeignKey('prodi_mahasiswa', 'prodi', 'id_prodi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
