<?php

namespace App\Controllers\Frond;

use DateTime;
use DateTimeZone;
use App\Models\JadwalModel;
use App\Models\ReservasiModel;
use App\Models\TreatmentModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;


class Reservasi extends BaseController
{
    use ResponseTrait;

    protected $treatment, $reservasi;

    public function __construct(){
       
        $this->treatment = new TreatmentModel();
        $this->reservasi = new ReservasiModel();
       
    }

    public function index($treatment = null)
    {
        $data = [
            'title' => 'reservasi',
            'treatment' => $this->treatment->getIdWithKategori($treatment)
        ];

        return view('frond/form_reservasi', $data);
    }

    public function getAuth()
    {
        $loggedInUser = user()->id;
        
        $authReservasi = $this->reservasi->getTreatmentByUser($loggedInUser);

        $data = [
            'authReservasi' => $authReservasi
        ];
        // \var_dump($authReservasi);

        return view('frond/reservasi', $data);
    }


    public function create()
    {
        $rules = [
            'tanggal_reservasi' => [
                'label' => 'Tanggal Reservasi ',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.',
                ]
            ],
            'jam_mulai' => [
                'label' => 'Jam Mulai',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
            'jam_selesai' => [
                'label' => 'Jam Selesai',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bidang {field} Tidak Boleh Kosong.'
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


    $data = $this->request->getPost(); //ambil inputan post
    $data['treatment_id'] = $this->request->getPost('treatment_id'); //ambil inputan post
    $data['kode_reservasi'] = 'RSV-' . date('Ymd'). '-'.  str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    $data['user_id'] = user()->id;

    $isValid = $this->checkReservationRange($data['jam_mulai'], $data['jam_selesai'], $data['tanggal_reservasi']);

    if ($isValid) {
        $exitsByUser = $this->checkExitsTangglByUser($data['user_id'] , $data['tanggal_reservasi']);

        if ($exitsByUser) {
            $this->reservasi->insert($data); // simpan ke database
            return redirect()->to(base_url('reservasi-saya'))->with('message', 'Berhasil Melakukan Reservasi.');
        }else{
            return redirect()->back()->with('error', 'Anda sudah melakukan reservasi pada tanggal' .' '. date('d/m/Y', strtotime($data['tanggal_reservasi'])));  
        }
    }else{
        return redirect()->back()->with('error', 'Waktu yang anda pilih sudah ada yang Reservasi');

    }

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

               

            // Pengecekan apakah waktu yang dimasukkan oleh user sesuai dengan jadwal
            $jadwalModel = new JadwalModel();
            $jadwal = $jadwalModel->getJadwalByDay($hari);

            $time = $selectedDate->format('H:i:s');

            if ($jadwal === null || $time < $jadwal->jam_buka || $time > $jadwal->jam_tutup) {  
                return $this->respond(['message' => 'Waktu yang Anda pilih tidak tersedia.']);
            }else{
                // return $this->respond(['message' => 'Waktu yang Anda pilih tersedia.']);

            }
    }

    public function ambilDurasi()
    {
        $jamMulai = $this->request->getPost('jamMulai'); // Mendapatkan nilai jamMulai dari permintaan AJAX
        $id = $this->request->getPost('idTreatment');

        // Query database untuk mendapatkan durasi berdasarkan jamMulai
        $durasi = $this->treatment->find($id);

        // return $this->respond($id);
        // Mengirim durasi sebagai respons JSON
        $response = array('durasi' => $durasi->durasi);
        echo json_encode($response);
    }


    public function getReservasiByTanggal()
    {
        $tanggal = $this->request->getPost('tanggal'); // Mendapatkan nilai jamMulai dari permintaan AJAX
      

        // Query database untuk mendapatkan durasi berdasarkan jamMulai
        $treatments = $this->reservasi->getAllByTanggal($tanggal);

        // return $this->respond($id);
        // Mengirim durasi sebagai respons JSON
        $response = array('treatments' => $treatments);
        echo json_encode($response);
    }


    private function checkReservationRange($jamMulai, $jamSelesai, $tanggal_reservasi)
    {
        $existingReservation = $this->reservasi
        ->where('tanggal_reservasi', $tanggal_reservasi)
            ->where('jam_mulai <', $jamSelesai)
            ->where('jam_selesai >', $jamMulai)
            ->countAllResults();

        return ($existingReservation > 0) ? false : true;
    }

    private function checkExitsTangglByUser($userId, $tanggalReservasi)
    {
        $existingReservation = $this->reservasi
        ->where('tanggal_reservasi',  $tanggalReservasi)
        ->where('user_id',  $userId)
        ->countAllResults();

        return ($existingReservation > 0) ? false : true;

    }


}