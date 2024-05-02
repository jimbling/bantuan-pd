<?php

namespace App\Models;

use CodeIgniter\Model;
use Google_Client;
use Google_Service_Drive;
use Google_Exception;

class DriveModel extends Model
{
    protected $table = 'drive_files'; // Nama tabel riwayat peminjaman
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $useAutoIncrement = true; // Pastikan ini true
    protected $useTimestamps = true; // Sesuaikan dengan kebutuhan Anda
    protected $allowedFields = ['id', 'file_name', 'google_drive_file_id', 'created_at'];

    public function uploadToDrive($file)
    {
        try {
            $client = new Google_Client();
            $client->setAuthConfig('assets/dist/gdrive/client_secret_643405018131-7gjb94f0nca2uh2lt11baalkr935i6sk.apps.googleusercontent.com.json');
            $client->addScope(Google_Service_Drive::DRIVE); // Scope untuk mengakses Google Drive
            $client->setAccessType('offline');

            // Inisialisasi service Google Drive
            $driveService = new Google_Service_Drive($client);

            // Data file yang akan diunggah
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => $file->getName(),
            ]);

            // Proses upload file
            $content = file_get_contents($file->getTempName());
            $driveFile = $driveService->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $file->getMimeType(),
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);

            // Simpan ID file yang diunggah ke database
            $this->insert([
                'file_name' => $file->getName(),
                'google_drive_file_id' => $driveFile->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return $driveFile->id;
        } catch (Google_Exception $e) {
            // Tangkap pengecualian Google_Exception
            // Anda dapat mencetak atau logging pesan kesalahan untuk memperoleh detailnya
            log_message('error', 'Google Drive Exception: ' . $e->getMessage());
            return null; // Gagal upload file
        } catch (Exception $e) {
            // Tangkap pengecualian lainnya
            log_message('error', 'Exception: ' . $e->getMessage());
            return null; // Gagal upload file
        }
    }
}
