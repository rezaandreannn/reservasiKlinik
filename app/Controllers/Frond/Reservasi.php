<?php

namespace App\Controllers\Frond;

use DateTime;
use DateTimeZone;
use App\Models\JadwalModel;
use App\Models\TreatmentModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;


class Reservasi extends BaseController
{
    use ResponseTrait;

    protected $treatment;

    public function __construct(){
       
        $this->treatment = new TreatmentModel();
       
    }

    public function index($treatment = null)
    {
        $data = [
            'title' => 'reservasi',
            'treatment' => $this->treatment->getIdWithKategori($treatment)
        ];

      

        return view('frond/form_reservasi', $data);
    }

    public function validasiWaktu(){
        
            $inputDate = $this->request->getPost('tanggal');
            $inputTime = $this->request->getPost('jam_mulai');

    
            $selectedDate = new \DateTime($inputDate . ' ' . $inputTime, new \DateTimeZone('Asia/Jakarta'));
    
            $day = $selectedDate->format('N');

            $hari = "";
                switch ($day) {
                case 1:
                    $hari = "Senin";
                    break;
                case 2:
                    $hari = "Selasa";
                    break;
                case 3:
                    $hari = "Rabu";
                    break;
                case 4:
                    $hari = "Kamis";
                    break;
                case 5:
                    $hari = "Jumat";
                    break;
                case 6:
                    $hari = "Sabtu";
                    break;
                case 7:
                    $hari = "Minggu";
                    break;
                }

                // dd($hari);

            // Pengecekan apakah waktu yang dimasukkan oleh user sesuai dengan jadwal
            $jadwalModel = new JadwalModel();
            $jadwal = $jadwalModel->getJadwalByDay($hari);

            $time = $selectedDate->format('H:i:s');

            if ($jadwal === null || $time < $jadwal->jam_buka || $time > $jadwal->jam_tutup) {  
                return $this->respond(['message' => 'Waktu yang Anda pilih tidak tersedia.'], 200);
            }else{
                return $this->respond(['message' => 'Waktu yang Anda pilih tersedia.'], 200);

            }
    
        
    }
}