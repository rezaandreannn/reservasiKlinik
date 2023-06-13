<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<section class="my-5 mb-5">
    <div class="container">
        <h2>Reservasi Treatment</h2>
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="card border-light mb-3">
                    <div class="card-header">Nama Treatment : <strong><?= $treatment->nama_treatment ?></strong> </div>
                    <div class="card-body">
                        <form action="<?= base_url('reservasi'); ?>" method="post" autocomplete="off">
                            <?= csrf_field() ?>
                            <input type="hidden" name="treatment_id" id="treatment_id" value="<?= $treatment->id ?>">
                            <div class="form-group">
                                <label for="tanggal_reservasi">Tanggal Reservasi</label>
                                <input type="date"
                                    class="form-control <?= session('errors.tanggal_reservasi') ? 'is-invalid' : '' ?>"
                                    id="tanggal_reservasi" min="<?php echo date('Y-m-d'); ?>" name="tanggal_reservasi">
                                <div class="invalid-feedback">
                                    <?= session('errors.tanggal_reservasi') ?>
                                </div>
                                <span id="error_message" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time"
                                    class="form-control <?= session('errors.jam_mulai') ? 'is-invalid' : '' ?>"
                                    id="jam_mulai" name="jam_mulai">
                                <div class="invalid-feedback">
                                    <?= session('errors.jam_mulai') ?>
                                </div>
                                <span id="jam_mulai_message" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time"
                                    class="form-control <?= session('errors.jam_selesai') ? 'is-invalid' : '' ?>"
                                    id="jam_selesai" min="<?php echo date('H:i', strtotime('+1 minute')); ?>"
                                    name="jam_selesai" readonly>
                                <div class="invalid-feedback">
                                    <?= session('errors.jam_selesai') ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="card border-light mb-3">
                    <div class="card-header">Data Reservasi <br> Tanggal : <strong id="tanggal_pilih"></strong></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                  <td></td>
                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection('main') ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
    $(document).ready(function () {
        $('#tanggal_reservasi').on('change', function () {
            var inputDate = new Date($('#tanggal_reservasi').val());
            var day = inputDate.getDay();
            var tahun = inputDate.getFullYear();
            var bulan = inputDate.getMonth() + 1;
            var tanggal = inputDate.getDate();
            var formattedDateIndonesia = tanggal + '-' + ('0' + bulan).slice(-2) + '-' + ('' + tahun)
                .slice();
            var formattedDate = tahun + '-' + ('0' + bulan).slice(-2) + '-' + ('0' + tanggal).slice(-2);
            var apiURL = 'https://api-harilibur.vercel.app/api?month=' + bulan + '&year=' + tahun + '';
            $.ajax({
                url: apiURL,
                type: 'GET',
                crossDomain: true,
                dataType: 'json',
                success: function (data) {

                    var isHoliday = false;
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].holiday_date == formattedDate) {
                            isHoliday = true;
                            break;
                        }
                    }
                    if (isHoliday || day == 0) { // 0 = Minggu
                        $('#tanggal_reservasi').val('');
                        $('#error_message').html(
                            'Maaf, tanggal tidak bisa dipilih pada hari libur atau hari Minggu'
                            );

                    } else {
                        $('#error_message').html('');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error); // menampilkan pesan error di console log
                }
            });

            // get reservasi by tgl
            $.ajax({
                url: "<?php echo base_url('jadwal/get_data_reservasi'); ?>",
                type: 'Post',
                dataType: 'json',
                data: {
                    tanggal: formattedDate,
                },
                success: function (data) {
                    $('#tanggal_pilih').html(formattedDateIndonesia);
                    // console.log(data)
                    $("tbody").empty();
                    if (data.treatments.length > 0) {
                        $.each(data.treatments, function (index, data) {
                            var row = $("<tr></tr>"); // Buat elemen <tr> baru


                            // Tambahkan kolom-kolom dengan data dari database ke dalam baris
                            row.append("<td>" + (index + 1) + "</td>");
                            row.append("<td>" + data.username + "</td>");
                            row.append("<td>" + moment(data.jam_mulai, "HH:mm")
                                .format("HH:mm") + "</td>");
                            row.append("<td>" + moment(data.jam_selesai, "HH:mm")
                                .format("HH:mm") + "</td>");

                            // Tambahkan baris ke dalam <tbody>
                            $("tbody").append(row);
                        });
                    } else {
                        var row = $("<tr></tr>"); // Buat elemen <tr> baru

                        row.append("<td>" + "Data kosong" + "</td>");

                        $("tbody").append(row);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error); // menampilkan pesan error di console log
                }
            });


        });
    });
</script>

<script>
    function validateInput() {
        var inputDate = document.getElementById("tanggal_reservasi").value;
        var inputTime = document.getElementById("jam_mulai").value;

        var today = new Date();
        var selectedDate = new Date(inputDate + "T" + inputTime + ":00+07:00");

        if (selectedDate < today) {
            var messageElem = document.getElementById("jam_mulai_message");
            if (messageElem) {
                messageElem.innerHTML = "Anda tidak dapat memilih waktu yang sudah lewat.";
            }
            document.getElementById("jam_mulai").value = "";
        } else {
            var messageElem = document.getElementById("jam_mulai_message");
            if (messageElem) {
                messageElem.innerHTML = "";
            }

            // request data jadwal menggunakan ajax
            $.ajax({
                url: "<?php echo base_url('jadwal/cek_jadwal'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tanggal: inputDate,
                    jam_mulai: inputTime
                },
                success: function (result) {
                    if (result.status === "success") {
                        // jadwal tersedia
                        // lanjutkan proses reservasi
                    } else {
                        // jadwal tidak tersedia
                        // tampilkan pesan error
                        var errorElem = document.getElementById("jam_mulai_message");
                        if (errorElem) {
                            errorElem.innerHTML = result.message;
                        }
                        document.getElementById("jam_selesai").value = "";
                        document.getElementById("jam_mulai").value = "";
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }

    document.getElementById("jam_mulai").addEventListener("change", validateInput);
</script>

<script>
    $(document).ready(function () {
        // Event listener untuk perubahan nilai pada input jam_mulai
        $("#jam_mulai").on("change", function () {
            var jamMulai = $(this).val(); // Nilai jam mulai yang diinputkan
            var idTreatment = $('#treatment_id').val();
            // var jamSelesai = $('#jam_selesai').val();


            // Mengirim permintaan AJAX untuk mengambil durasi dari database
            $.ajax({
                url: "<?php echo base_url('ambil_durasi'); ?>", // Ganti dengan URL yang sesuai untuk mengambil durasi dari database
                method: "POST",
                dataType: "json",
                data: {
                    jamMulai: jamMulai,
                    idTreatment: idTreatment
                }, // Mengirim jamMulai ke server
                success: function (response) {
                    // console.log(response);
                    // Menghitung jam selesai dengan menambahkan durasi ke jam mulai
                    var durasi = response.durasi; // Duration from the database
                    var jamSelesai = moment(jamMulai, "HH:mm").add(durasi, "minutes")
                        .format("HH:mm");

                    // Checking if Jam Selesai is within office hours (8 AM to 5:30 PM)
                    var officeStart = moment("08:00", "HH:mm");
                    var officeEnd = moment("17:30", "HH:mm");
                    var jamSelesaiMoment = moment(jamSelesai, "HH:mm");

                    if (jamSelesaiMoment.isBefore(officeStart) || jamSelesaiMoment.isAfter(
                            officeEnd)) {
                        // Clearing Jam Selesai value and showing an error message
                        $("#jam_selesai").val("");
                        // $("#jam_selesai_message").innerHTML("Jam Selesai harus berada dalam jam kantor (8 AM - 5:30 PM).");
                        var errorElem = document.getElementById("jam_mulai_message");
                        errorElem.innerHTML =
                            "Jam Selesai harus berada dalam jam kantor (08:00 Wib - 17:30 Wib)";

                    } else {
                        // Setting the value of Jam Selesai and clearing the error message
                        $("#jam_selesai").val(jamSelesai);
                        $("#jam_selesai_message").text("");
                    }
                    // Mengisi nilai jam selesai pada input
                    // $("#jam_selesai").val(jamSelesai);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });

        });
    });
</script>

<!-- flashdata message data -->
<?php if (session()->getFlashdata('message')) : ?>
<?php $message = session()->getFlashdata('message'); ?>
<script>
    Swal.fire(
        'Sukses! 😆',
        '<?= $message ?>',
        'success'
    )
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
<?php $error = session()->getFlashdata('error'); ?>
<script>
    Swal.fire(
        'Error! 😞',
        '<?= $error ?>',
        'error'
    )
</script>
<?php endif; ?>

<?= $this->endSection() ?>