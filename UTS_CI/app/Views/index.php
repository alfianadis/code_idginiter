<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Pemrograman Web 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div class="modal fade" id="add_mahasiswa_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="add_mahasiswa_form" novalidate>
                    <div class="modal-body p-5">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama_mahasiswa" class="form-control" placeholder="Nama" required>
                            <div class="invalid-feedback">Nama mahasiswa harus diisi!</div>
                        </div>
                        <div class="mb-3">
                            <label>Nim</label>
                            <input type="text" name="nim_mahasiswa" class="form-control" placeholder="Nim" required>
                            <div class="invalid-feedback">Nim mahasiswa harus diisi!</div>
                        </div>
                        <div class="mb-3">
                            <label>Prodi</label>
                            <select class="form-select" name="prodi_mahasiswa" aria-label="Default select example" id="show_options_1" required>
                            </select>
                            <div class="invalid-feedback">Prodi mahasiswa harus diisi!</div>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="file" id="image_mahasiswa" class="form-control" required>
                            <div class="invalid-feedback">Foto mahasiswa harus diisi!</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="add_mahasiswa_btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_mahasiswa_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Rubah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="edit_mahasiswa_form" novalidate>
                    <input type="hidden" name="id_mahasiswa" id="id_mahasiswa">
                    <input type="hidden" name="old_image_mahasiswa" id="old_image_mahasiswa">
                    <div class="modal-body p-5">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" placeholder="Nama" required>
                            <div class="invalid-feedback">Nama mahasiswa harus diisi!</div>
                        </div>
                        <div class="mb-3">
                            <label>Nim</label>
                            <input type="text" name="nim_mahasiswa" id="nim_mahasiswa" class="form-control" placeholder="Nim" required>
                            <div class="invalid-feedback">Nim mahasiswa harus diisi!</div>
                        </div>
                        <div class="mb-3">
                            <label>Prodi</label>
                            <select class="form-select" name="prodi_mahasiswa" id="show_options_2" aria-label="Default select example" required>
                            </select>
                            <div class="invalid-feedback">Prodi mahasiswa harus diisi!</div>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="file" id="image_mahasiswa" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="edit_mahasiswa_btn">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="row my-4">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="text-secondary fw-bold fs-3">Menu</div>
                            </div>
                            <div class="card-body">
                                <a href="/prodi"><button class="btn btn-info input-block-level form-control">Program Studi</button></a>
                                <hr class="hr" />
                                <a href="/"><button class="btn btn-warning input-block-level form-control">Mahasiswa</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row my-4">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="text-secondary fw-bold fs-3">Data Mahasiswa</div>
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_mahasiswa_modal">Tambah</button>
                            </div>
                            <div class="card-body">
                                <div class="row" id="show_mahasiswa">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $("#add_mahasiswa_form").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                if (!this.checkValidity()) {
                    e.preventDefault();
                    $(this).addClass('was-validated');
                } else {
                    $("#add_mahasiswa_btn").text("Adding...");
                    $.ajax({
                        url: '<?= base_url('/add') ?>',
                        method: 'post',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.error) {
                                $("#image_mahasiswa").addClass('is-invalid');
                                $("#image_mahasiswa").next().text(response.message.image_mahasiswa);
                            } else {
                                $("#add_mahasiswa_modal").modal('hide');
                                $("#add_mahasiswa_form")[0].reset();
                                $("#image_mahasiswa").removeClass('is-invalid');
                                $("#image_mahasiswa").next().text('');
                                $("#add_mahasiswa_form").removeClass('was-validated');
                                Swal.fire(
                                    'Added',
                                    response.message,
                                    'success'
                                );
                                fetchAllmahasiswa();
                            }
                            $("#add_mahasiswa_btn").text("Tambah");
                        }
                    });
                }
            });

            $(document).delegate('.mahasiswa_edit_btn', 'click', function(e) {
                e.preventDefault();
                const id = $(this).attr('id');
                $.ajax({
                    url: '<?= base_url('/edit/') ?>/' + id,
                    method: 'get',
                    success: function(response) {
                        $("#id_mahasiswa").val(response.message.id_mahasiswa);
                        $("#nama_mahasiswa").val(response.message.nama_mahasiswa);
                        $("#nim_mahasiswa").val(response.message.nim_mahasiswa);
                        $("#show_options_2").val(response.message.prodi_mahasiswa);
                        $("#old_image_mahasiswa").val(response.message.image_mahasiswa);
                    }
                });
            });

            $("#edit_mahasiswa_form").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $("#edit_mahasiswa_btn").text("Updating...");
                $.ajax({
                    url: '<?= base_url('/update/') ?>',
                    method: 'post',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        $("#edit_mahasiswa_modal").modal('hide');
                        Swal.fire(
                            'Updated',
                            response.message,
                            'success'
                        );
                        fetchAllmahasiswa();
                        $("#edit_mahasiswa_btn").text("Perbarui");
                        $("#edit_mahasiswa_form")[0].reset();
                    }
                });
            });

            $(document).delegate('.mahasiswa_delete_btn', 'click', function(e) {
                e.preventDefault();
                const id = $(this).attr('id');
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Anda tidak akan bisa mengembalikan datanya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url('/delete/') ?>/' + id,
                            method: 'get',
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                )
                                fetchAllmahasiswa();
                            }
                        });
                    }
                })
            });

            fetchAllmahasiswa();
            fetchOptions();

            function fetchAllmahasiswa() {
                $.ajax({
                    url: '<?= base_url('/fetch') ?>',
                    method: 'get',
                    success: function(response) {
                        $("#show_mahasiswa").html(response.message);
                    }
                });
            }

            function fetchOptions() {
                $.ajax({
                    url: '<?= base_url('/fetch_option') ?>',
                    method: 'get',
                    success: function(response) {
                        $("#show_options_2").html(response.message);
                        $("#show_options_1").html(response.message);
                    }
                });
            }
        });
    </script>

</body>

</html>