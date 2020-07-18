<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Survey</title>
    <style>
        .list-group-item {
            user-select: none;
        }

        .list-group input[type="checkbox"] {
            display: none;
        }

        .list-group input[type="checkbox"] + .list-group-item {
            cursor: pointer;
        }

        .list-group input[type="checkbox"] + .list-group-item:before {
            content: "\2713";
            color: transparent;
            font-weight: bold;
            margin-right: 1em;
        }

        .list-group input[type="checkbox"]:checked + .list-group-item {
            background-color: #0275D8;
            color: #FFF;
        }

        .list-group input[type="checkbox"]:checked + .list-group-item:before {
            color: inherit;
        }

        .list-group input[type="radio"] {
            display: none;
        }

        .list-group input[type="radio"] + .list-group-item {
            cursor: pointer;
        }

        .list-group input[type="radio"] + .list-group-item:before {
            content: "\2022";
            color: transparent;
            font-weight: bold;
            margin-right: 1em;
        }

        .list-group input[type="radio"]:checked + .list-group-item {
            background-color: #0275D8;
            color: #FFF;
        }

        .list-group input[type="radio"]:checked + .list-group-item:before {
            color: inherit;
        }
    </style>
</head>
<body class="bg-light">
<div class="container p-0">

    <div class="p-4 text-center bg-white">
        <img src="https://image.freepik.com/free-vector/group-checking-giant-check-list-background_23-2148084372.jpg" alt="" class="img-fluid m-75 mx-auto">
        <h4>Judul Halaman</h4>
        <h6>Deskripsi Blabvalblablablal</h6>
        <table>
            <tr>
                <td>Nama</td>
                <td>: Otomatis by login</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: Otomatis by login</td>
            </tr>
            <tr>
                <td>Cluster</td>
                <td>: Otomatis by login</td>
            </tr>
            <tr>
                <td>Micro Cluster</td>
                <td>: Otomatis by login</td>
            </tr>

        </table>
    </div>

    <div class="card my-2">
        <div class="card-body">
            <label>Canvasser</label>
            <select class="form-control" id="">
                <option value="">Pilih</option>
                <option value="">Pilih</option>
                <option value="">Pilih</option>
                <option value="">Pilih</option>
                <option value="">Pilih</option>
                <option value="">Pilih</option>
                <option value="">Pilih</option>
            </select>
        </div>
    </div>

    <div class="card my-2">
        <div class="card-body">
            <label>Ro</label>
            <select class="form-control" id="">
                <option value="">No Dompul - Nama RO</option>
                <option value="">No Dompul - Nama RO</option>
                <option value="">No Dompul - Nama RO</option>
                <option value="">No Dompul - Nama RO</option>
                <option value="">No Dompul - Nama RO</option>
                <option value="">No Dompul - Nama RO</option>
                <option value="">No Dompul - Nama RO</option>
            </select>
        </div>
    </div>

    <?php for($i = 1; $i<= 5; $i++): ?>
    <div class="card p-0 my-2">
        <div class="card-header bg-white sticky-top">
            <strong class="m-2">Ini adalah pertanyaan ke - <?php echo $i ?></strong>
        </div>
        <div class="card-body p-0">
            <div class="list-group">
                <input type="radio" name="opsike<?php echo $i ?>" value="Value1" id="Radio1-<?php echo $i ?>" />
                <label class="list-group-item" for="Radio1-<?php echo $i ?>">Caption for Radio1</label>

                <input type="radio" name="opsike<?php echo $i ?>" value="Value2" id="Radio2-<?php echo $i ?>" />
                <label class="list-group-item" for="Radio2-<?php echo $i ?>">Caption for Radio2</label>

                <input type="radio" name="opsike<?php echo $i ?>" value="Value3" id="Radio3-<?php echo $i ?>" />
                <label class="list-group-item" for="Radio3-<?php echo $i ?>">Caption for Radio3</label>

            </div>
        </div>
    </div>
    <?php endfor; ?>

    <div class="card p-0 my-2">
        <div class="card-header bg-white">
            <strong class="m-2">Upload Foto</strong>
        </div>
        <div class="card-body">
            <input type="file" accept="image/*" capture="camera">
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg mx-auto m-4" data-toggle="modal" data-target="#modelId">
        Simpan
    </button>
</div>



<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Konfirmasi simpan
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
