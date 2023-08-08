@extends('main')
@section('content')
<div class="statistics-card">
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modaladd"><i
            class="fas fa-plus"></i> Tambah Suplier</button>
    <table id="table-suplier" class="table" style="width:100%">
        <thead>
            <tr>
                <th>No. </th>
                <th>Nama Suplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th class="text-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($suplier as $row)
            <tr style="vertical-align: middle">
                <td style="width: 8%">{{ $no++ }}</td>
                <td>{{ $row->nama_suplier }}</td>
                <td>{{ $row->alamat }}</td>
                <td>{{ $row->telepon }}</td>
                <td class="text-nowrap">
                    <a href="javascript:;" onclick="editData('{{ encrypt_url($row->id_suplier) }}')"
                        class="btn btn-warning btn-sm text-light">Edit</a>
                    <a href="javascript:;" onclick="deleteData('{{ encrypt_url($row->id_suplier) }}')"
                        class="btn btn-danger btn-sm ms-1">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal add-->
<div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Suplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formadd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="namaadd" class="text-muted">Nama Suplier</label>
                        <input type="text" class="form-control" id="namaadd" placeholder="input nama pengguna"
                            name="nama">
                        <div id="errornamaadd" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamatadd" class="text-muted">Alamat</label>
                        <input type="text" class="form-control" id="alamatadd" placeholder="input alamat" name="alamat">
                        <div id="erroralamatadd" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="teleponadd" class="text-muted">Telepon</label>
                        <input type="text" class="form-control" id="teleponadd" placeholder="input telepon"
                            name="telepon">
                        <div id="errorteleponadd" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="btnadd" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal add-->

<!-- Modal edit-->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Suplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formedit" enctype="multipart/form-data">
                <input type="hidden" name="id" id="idedit">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="namaedit" class="text-muted">Nama Suplier</label>
                        <input type="text" class="form-control" id="namaedit" placeholder="input nama pengguna"
                            name="nama">
                        <div id="errornamaedit" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamatedit" class="text-muted">Alamat</label>
                        <input type="text" class="form-control" id="alamatedit" placeholder="input alamat"
                            name="alamat">
                        <div id="erroralamatedit" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="teleponedit" class="text-muted">Telepon</label>
                        <input type="text" class="form-control" id="teleponedit" placeholder="input telepon"
                            name="telepon">
                        <div id="errorteleponedit" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="btnedit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal edit-->
@endsection
@push('js_function')
<script>
    $('#table-suplier').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: "",
            sSearch: "Cari"
        },
    });

    $("#formadd").submit(function(e) {
        $("#btnadd").prop('disabled', true);
        $("#errornamaadd").html("");
        $("#erroralamatadd").html("");
        $("#errorteleponadd").html("");
    
        const formdata = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            url: "{{ route('data-suplier.store') }}",
            data: formdata,
            dataType: 'json',
            success: function(response) {
                $("#btnadd").prop('disabled', false);
                if (response.status == "1") {
                    swal.fire({
                        icon: "success",
                        title: 'Berhasil',
                        text: response.msg,
                        showConfirmButton: true,
                        timer: 900
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 900);
                }else{
                    swal.fire({
                        icon: "error",
                        title: 'Gagal !',
                        text: response.msg,
                        showConfirmButton: true,
                        timer: 900
                    });
                }
            },
            error: function(response) {
                $("#btnadd").prop('disabled', false);
                if (typeof response.responseJSON.errors !== 'undefined') 
                {
                    let errors = response.responseJSON.errors;
                    if (typeof errors.nama !== 'undefined'){
                        $("#namaadd").attr('class', 'form-control is-invalid');
                        $("#errornamaadd").html(errors.nama[0]);
                    }else{
                        $("#namaadd").attr('class', 'form-control');
                    } 
                    if (typeof errors.alamat !== 'undefined'){
                        $("#alamatadd").attr('class', 'form-control is-invalid');
                        $("#erroralamatadd").html(errors.alamat[0]);
                    }else{
                        $("#alamatadd").attr('class', 'form-control');
                    } 
                    if (typeof errors.telepon !== 'undefined'){
                        $("#teleponadd").attr('class', 'form-control is-invalid');
                        $("#errorteleponadd").html(errors.telepon[0]);
                    }else{
                        $("#teleponadd").attr('class', 'form-control');
                    }
                }
            }
        });
        e.preventDefault();
    });

    function editData(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "{{ route('data-suplier.detail') }}",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == "1") {
                    data = response.suplier[0];
                    $("#idedit").val(id);
                    $("#namaedit").val(data.nama_suplier);
                    $("#alamatedit").val(data.alamat);
                    $("#teleponedit").val(data.telepon);
                    $('#modaledit').modal('show');
                } else {
                    Swal.fire("Oops!", "Try Again!", "error");
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                swal.fire(
                    'Error',
                    'SQL Error Inserting Data',
                    'error'
                )
            }
        });
    }

    $("#formedit").submit(function(e) {
        $("#btnedit").prop('disabled', true);
        $("#errornamaedit").html("");
        $("#erroralamatedit").html("");
        $("#errorteleponedit").html("");
        
        const formdata = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            url: "{{ route('data-suplier.update') }}",
            data: formdata,
            dataType: 'json',
            success: function(response) {
                $("#btnedit").prop('disabled', false);
                if (response.status == "1") {
                    swal.fire({
                        icon: "success",
                        title: 'Berhasil',
                        text: response.msg,
                        showConfirmButton: true,
                        timer: 900
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 900);
                }else{
                    swal.fire({
                        icon: "error",
                        title: 'Gagal !',
                        text: response.msg,
                        showConfirmButton: true,
                        timer: 900
                    });
                }
            },
            error: function(response) {
                $("#btnedit").prop('disabled', false);
                if (typeof response.responseJSON.errors !== 'undefined') 
                {
                    let errors = response.responseJSON.errors;
                    if (typeof errors.nama !== 'undefined'){
                        $("#namaedit").attr('class', 'form-control is-invalid');
                        $("#errornamaedit").html(errors.nama[0]);
                    }else{
                        $("#namaedit").attr('class', 'form-control');
                    } 
                    if (typeof errors.alamat !== 'undefined'){
                        $("#alamatedit").attr('class', 'form-control is-invalid');
                        $("#erroralamatedit").html(errors.alamat[0]);
                    }else{
                        $("#alamatedit").attr('class', 'form-control');
                    } 
                    if (typeof errors.telepon !== 'undefined'){
                        $("#teleponedit").attr('class', 'form-control is-invalid');
                        $("#errorteleponedit").html(errors.telepon[0]);
                    }else{
                        $("#teleponedit").attr('class', 'form-control');
                    }
                }
            }
        });
        e.preventDefault();
    });

    function deleteData(id) {
        swal.fire({
            title: 'Apakah anda yakin??',
            text: "Anda tidak dapat mengembalikan data ini !!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonClass: 'btn btn-danger me-3',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('data-suplier.destroy') }}",
                    data: 'id=' + id,
                    success: function(response) {
                        if (response.status == "1") {
                            swal.fire({
                                icon: "success",
                                title: 'Berhasil',
                                text: response.msg,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal.fire("Error!", response.msg, "error");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        swal.fire('Error', 'SQL Error Inserting Data', 'error')
                    }
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                );
            }
        });
    }
</script>
@endpush