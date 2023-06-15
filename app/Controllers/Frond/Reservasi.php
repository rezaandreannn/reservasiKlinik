<?php

namespace App\Controllers\Frond;

use DateTime;
use DateTimeZone;
use App\Models\JadwalModel;
use App\Models\BankModel;
use App\Models\ReservasiModel;
use App\Models\TreatmentModel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;


class Reservasi extends BaseController
{
    use ResponseTrait;

    protected $treatment, $reservasi, $bank;

    public function __construct(){
       
        $this->treatment = new TreatmentModel();
        $this->reservasi = new ReservasiModel();
        $this->bank = new BankModel();
       
    }

    public function index($treatment = null)
    {
        $data = [
            'title' => 'reservasi',
            'treatment' => $this->treatment->getIdWithKategori($treatment),
            'banks' => $this->bank->findAll()
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

    public function getAuthHistori()
    {
        $loggedInUser = user()->id;
        
        $authReservasi = $this->reservasi->getTreatmentByUserHistori($loggedInUser);

        $data = [
            'authReservasi' => $authReservasi
        ];
        // \var_dump($authReservasi);

        return view('frond/histori', $data);
    }

    public function cetakAuthHistori()
    {
        $loggedInUser = user()->id;
        
        $authReservasi = $this->reservasi->getTreatmentByUserHistori($loggedInUser);

        $data = [
            'authReservasi' => $authReservasi
        ];
      

        return view('frond/cetak-histori', $data);
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

    $jumlahBayar = intval(str_replace('.','', $this->request->getPost('jumlah_bayar')));
  

    $data['type_pembayaran'] = $this->request->getPost('type_bayar');
    if ($this->request->getPost('type_bayar') == 'bayar online') {
       $data['bank_id'] = $this->request->getPost('bank_id');
    }
    $data['treatment_id'] = $this->request->getPost('treatment_id'); //ambil inputan post
    $data['kode_reservasi'] = 'RSV-' . date('Ymd'). '-'.  str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    $data['user_id'] = user()->id;
    $data['jumlah_bayar'] = $jumlahBayar;

    $isValid = $this->checkReservationRange($data['jam_mulai'], $data['jam_selesai'], $data['tanggal_reservasi']);

    if ($isValid) {
        $exitsByUser = $this->checkExitsTangglByUser($data['user_id'] , $data['tanggal_reservasi']);

        if ($exitsByUser) {
            $this->reservasi->insert($data); 
            // pesan berdasakan tipe
            if ($data['type_pembayaran'] == 'bayar offline') {
               $message = 'Lakukan Pembayaran saat anda selesai melakukan treatment';
            }else{
                $message = 'Lakukan Pembayaran sebelum tanggal ' . $this->request->getPost('tanggal_reservasi') .' dan segera upload bukti bayar';
            }

            return redirect()->to(base_url('reservasi-saya'))->with('message', 'Berhasil Melakukan Reservasi.\n'.$message.'');
        }else{
            return redirect()->back()->with('error', 'Anda sudah melakukan reservasi dengan status pending pada tanggal' .' '. date('d/m/Y', strtotime($data['tanggal_reservasi'])));  
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
            ->where('status_reservasi', 'pending')
            ->countAllResults();

        return ($existingReservation > 0) ? false : true;
    }

    private function checkExitsTangglByUser($userId, $tanggalReservasi)
    {
        $existingReservation = $this->reservasi
        ->where('tanggal_reservasi',  $tanggalReservasi)
        ->where('user_id',  $userId)
        ->where('status_reservasi', 'pending')
        ->countAllResults();

        return ($existingReservation > 0) ? false : true;

    }

    public function batalReservasi($id = null)
    {
        $data = [
            'status_reservasi' => 'batal',
        ];

        $this->reservasi->update($id, $data); // simpan ke database
         return redirect()->back()->with('message', 'Reservasi dibatalkan');
    }
    // public function cetak()
    // {
    //     // create new PDF document
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
    //     // set document information
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Sobatcoding.com');
    //     $pdf->SetTitle('PDF Sobatcoding.com');
    //     $pdf->SetSubject('TCPDF Tutorial');
    //     $pdf->SetKeywords('TCPDF, PDF, example, sobatcoding.com');

    //     // set default header data
    //     $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    //     $pdf->setFooterData(array(0,64,0), array(0,64,128));

    //     // set header and footer fonts
    //     $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //     $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //     // set default monospaced font
    //     $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //     // set margins
    //     $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    //     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    //     $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    //     // set auto page breaks
    //     $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //     // set image scale factor
    //     $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //     // set default font subsetting mode
    //     $pdf->setFontSubsetting(true);

    //     // Set font
    //     // dejavusans is a UTF-8 Unicode font, if you only need to
    //     // print standard ASCII chars, you can use core fonts like
    //     // helvetica or times to reduce file size.
    //     $pdf->SetFont('dejavusans', '', 14, '', true);

    //     // Add a page
    //     // This method has several options, check the source code documentation for more information.
    //     $pdf->AddPage();

    //    //view mengarah ke invoice.php
    //     $html = view('invoice');

    //     // Print text using writeHTMLCell()
    //     $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    //     // ---------------------------------------------------------
    //     $this->response->setContentType('application/pdf');
    //     // Close and output PDF document
    //     // This method has several options, check the source code documentation for more information.
    //     $pdf->Output('invoice-pos-sobatcoding.pdf', 'I');
    // }


}