@extends('main')
@section('content')
<div class="statistics-card">
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modaladd"><i
            class="fas fa-plus"></i> Tambah Pengguna</button>
    <table id="table-pengguna" class="table nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No. </th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th class="text-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($pengguna as $row)
            <tr style="vertical-align: middle">
                <td style="width: 8%">
                    <?= $no++ ?>
                </td>
                <td style="width: 10%">
                    <a href="{{ asset($row->foto) }}" target="_blank"><img src="{{ asset($row->foto) }}" width="50%"
                            alt=""></a>
                </td>
                <td>
                    <?= $row->nama_user ?>
                </td>
                <td>
                    <?= $row->username ?>
                </td>
                <td>
                    <?= get_role($row->role) ?>
                </td>
                <td class="text-nowrap">
                    <a href="javascript:;" onclick="editData('{{ encrypt_url($row->id_user) }}')"
                        class="btn btn-warning btn-sm text-light">Edit</a>
                    @if (Auth::user()->id_user != $row->id_user)
                    <a href="javascript:;" onclick="deleteData('{{ encrypt_url($row->id_user) }}')"
                        class="btn btn-danger btn-sm ms-1">Hapus</a>
                    @endif
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formadd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="namaadd" class="text-muted">Nama</label>
                        <input type="text" class="form-control" id="namaadd" placeholder="input nama pengguna"
                            name="nama">
                        <div id="errornamaadd" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="usernameadd" class="text-muted">Username</label>
                        <input type="text" class="form-control" id="usernameadd" placeholder="input username"
                            name="username">
                        <div id="errorusernameadd" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="passwordadd" class="text-muted">Password</label>
                        <input type="text" class="form-control" id="passwordadd" placeholder="input password"
                            name="password">
                        <div id="errorpasswordadd" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="roleadd" class="text-muted">Role</label>
                        <select id="roleadd" name="role" class="form-select">
                            <option value="">-Pilih-</option>
                            <option value="1">{{ get_role('1') }}</option>
                            <option value="2">{{ get_role('2') }}</option>
                            <option value="3">{{ get_role('3') }}</option>
                            <option value="4">{{ get_role('4') }}</option>
                        </select>
                        <div id="errorroleadd" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fotoadd" class="text-muted">Foto</label>
                        <input type="file" accept="image/*" class="form-control" id="fotoadd" name="foto">
                        <div id="errorfotoadd" class="invalid-feedback"></div>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formedit" enctype="multipart/form-data">
                <input type="hidden" name="id" id="idedit">
                <input type="hidden" name="usernameold" id="usernameoldedit">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="namaedit" class="text-muted">Nama</label>
                        <input type="text" class="form-control" id="namaedit" placeholder="input nama pengguna"
                            name="nama">
                        <div id="errornamaedit" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="usernameedit" class="text-muted">Username</label>
                        <input type="text" class="form-control" id="usernameedit" placeholder="input username"
                            name="username">
                        <div id="errorusernameedit" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="roleedit" class="text-muted">Role</label>
                        <select id="roleedit" name="role" class="form-select">
                            <option value="">-Pilih-</option>
                            <option value="1">{{ get_role('1') }}</option>
                            <option value="2">{{ get_role('2') }}</option>
                            <option value="3">{{ get_role('3') }}</option>
                            <option value="4">{{ get_role('4') }}</option>
                        </select>
                        <div id="errorroleedit" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="passwordedit" class="text-muted">Password</label>
                        <input type="text" class="form-control" id="passwordedit" placeholder="" name="password">
                        <span class="text-muted" style="font-size: 10px">*Kosongkan bila tidak ingin memperbarui
                            password</span>
                        <div id="errorpasswordedit" class="invalid-feedback"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fotoedit" class="text-muted">Foto</label>
                        <input type="file" accept="image/*" class="form-control" id="fotoedit" name="foto">
                        <span class="text-muted" style="font-size: 10px">*Kosongkan bila tidak ingin memperbarui
                            foto</span>
                        <div id="errorfotoedit" class="invalid-feedback"></div>
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
    $('#table-pengguna').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: "",
            sSearch: "Cari"
        },
    });

    $("#formadd").submit(function(e) {
        $("#btnadd").prop('disabled', true);
        $("#errornamaadd").html("");
        $("#errorusernameadd").html("");
        $("#errorpasswordadd").html("");
        $("#errorroleadd").html("");
        $("#errorfotoadd").html("");
        
        const formdata = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            url: "{{ route('data-pengguna.store') }}",
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
                }else if (response.status == "00") {
                    $("#usernameadd").attr('class', 'form-control is-invalid');
                    $("#errorusernameadd").html("Username sudah digunakan!");
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
                    if (typeof errors.username !== 'undefined'){
                        $("#usernameadd").attr('class', 'form-control is-invalid');
                        $("#errorusernameadd").html(errors.username[0]);
                    }else{
                        $("#usernameadd").attr('class', 'form-control');
                    } 
                    if (typeof errors.password !== 'undefined'){
                        $("#passwordadd").attr('class', 'form-control is-invalid');
                        $("#errorpasswordadd").html(errors.password[0]);
                    }else{
                        $("#passwordadd").attr('class', 'form-control');
                    }
                    if (typeof errors.role !== 'undefined'){
                        $("#roleadd").attr('class', 'form-select is-invalid');
                        $("#errorroleadd").html(errors.role[0]);
                    }else{
                        $("#roleadd").attr('class', 'form-select');
                    }
                    if (typeof errors.foto !== 'undefined'){
                        $("#fotoadd").attr('class', 'form-control is-invalid');
                        $("#errorfotoadd").html(errors.foto[0]);
                    }else{
                        $("#fotoadd").attr('class', 'form-control');
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
            url: "{{ route('data-pengguna.detail') }}",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == "1") {
                    data = response.pengguna[0];
                    $("#idedit").val(id);
                    $("#namaedit").val(data.nama_user);
                    $("#usernameedit").val(data.username);
                    $("#usernameoldedit").val(data.username);
                    $("#roleedit").val(data.role).change();
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
        $("#errorusernameedit").html("");
        $("#errorpasswordedit").html("");
        $("#errorroleedit").html("");
        $("#errorfotoedit").html("");
        
        const formdata = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            url: "{{ route('data-pengguna.update') }}",
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
                }else if (response.status == "00") {
                    $("#usernameedit").attr('class', 'form-control is-invalid');
                    $("#errorusernameedit").html("Username sudah digunakan!");
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
                    if (typeof errors.username !== 'undefined'){
                        $("#usernameedit").attr('class', 'form-control is-invalid');
                        $("#errorusernameedit").html(errors.username[0]);
                    }else{
                        $("#usernameedit").attr('class', 'form-control');
                    } 
                    if (typeof errors.password !== 'undefined'){
                        $("#passwordedit").attr('class', 'form-control is-invalid');
                        $("#errorpasswordedit").html(errors.password[0]);
                    }else{
                        $("#passwordedit").attr('class', 'form-control');
                    }
                    if (typeof errors.role !== 'undefined'){
                        $("#roleedit").attr('class', 'form-select is-invalid');
                        $("#errorroleedit").html(errors.role[0]);
                    }else{
                        $("#roleedit").attr('class', 'form-select');
                    }
                    if (typeof errors.foto !== 'undefined'){
                        $("#fotoedit").attr('class', 'form-control is-invalid');
                        $("#errorfotoedit").html(errors.foto[0]);
                    }else{
                        $("#fotoedit").attr('class', 'form-control');
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
                    url: "{{ route('data-pengguna.destroy') }}",
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