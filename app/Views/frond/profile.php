<?= $this->extend('layout/landingpage') ?>

<?= $this->section('main') ?>
<!-- Treatment Cards Section -->
<section class="my-5">
    <div class="container">
        <h2>Profile</h2>
        <div class="row">


            <div class="col-md-4">
                <div class="card my-3" style="width: 18rem;">
                    <div class="card-header">
                        Featured
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection('main') ?>