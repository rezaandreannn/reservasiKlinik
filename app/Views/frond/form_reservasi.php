<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<section class="my-5 mb-5">
    <div class="container">
        <h2>Reservasi Treatment</h2>
        <div class="row">
            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header">Nama Treatment : <?= $treatment->nama_treatment ?> </div>
                    <div class="card-body">
                        <form>
                            <input type="hidden" name="treatment_id" value="<?= $treatment->id ?>">
                            <div class="form-group">
                                <label for="tanggal_reservasi">Tanggal Reservasi</label>
                                <input type="date" class="form-control" id="tanggal_reservasi"
                                    min="<?php echo date('Y-m-d'); ?>">
                                    <span id="error_message" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai"
                                    >
                                    <span id="jam_mulai_message" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai"
                                    min="<?php echo date('H:i', strtotime('+1 minute')); ?>" readonly>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection('main') ?>

<!-- Page Specific JS File -->
<?= $this->section('jsSpesific') ?>

<script>
     $(document).ready(function() {
    $('#tanggal_reservasi').on('change', function() {
    var inputDate = new Date($('#tanggal_reservasi').val());
    var day = inputDate.getDay();
    var tahun = inputDate.getFullYear();
    var bulan = inputDate.getMonth() + 1;
    var tanggal = inputDate.getDate();
    var formattedDate = tahun + '-' + ('0' + bulan).slice(-2) + '-' + ('0' + tanggal).slice(-2);
    var apiURL = 'https://api-harilibur.vercel.app/api?month='+ bulan +'&year='+ tahun +'';
    $.ajax({
      url: apiURL,
      type: 'GET',
      crossDomain: true,
      dataType: 'json',
      success: function(data) {

        var isHoliday = false;
        for (var i = 0; i < data.length; i++) {
          if (data[i].holiday_date == formattedDate) {
            isHoliday = true;
            break;
          }
        }
        if (isHoliday || day == 0) { // 0 = Minggu
          $('#tanggal_reservasi').val('');
          $('#error_message').html('Maaf, tanggal tidak bisa dipilih pada hari libur atau hari Minggu');
          
        } else {
          $('#error_message').html('');
        }
      },
      error: function(xhr, status, error) {
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
  }
  else {
    var messageElem = document.getElementById("jam_mulai_message");
    if (messageElem) {
      messageElem.innerHTML = "";
    }

    // request data jadwal menggunakan ajax
    $.ajax({
      url: "<?php echo base_url('jadwal/cek_jadwal'); ?>",
      type: "POST",
      dataType: "json",
      data: {tanggal: inputDate, jam_mulai: inputTime},
      success: function(result) {
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
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
}


document.getElementById("jam_mulai").addEventListener("change", validateInput);
</script>

<script>
    function setJamSelesai(jamMulai) {
        // Konversi jamMulai ke format waktu
        var mulai = new Date('1970-01-01T' + jamMulai + ':00Z');

        // Tambahkan 1 jam ke jamMulai
        var selesai = new Date(mulai.getTime() + (60 * 60 * 1000));

        // Format jamSelesai menjadi string "HH:mm"
        var jamSelesai = ('0' + selesai.getHours()).slice(-2) + ':' + ('0' + selesai.getMinutes()).slice(-2);

        // Set nilai jamSelesai pada input
        document.getElementById('jam_selesai').value = jamSelesai;
    }
</script>


<?= $this->endSection() ?>