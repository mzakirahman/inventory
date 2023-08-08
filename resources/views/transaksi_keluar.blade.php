@extends('main')
@section('content')
<div class="statistics-card">
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modaladd"><i
            class="fas fa-plus"></i> Tambah Transaksi</button>
    <table id="table-suplier" class="table" style="width:100%">
        <thead>
            <tr>
                <th>No. </th>
                <th>From Location Code</th>
                <th>To Location Code</th>
                <th>Serial No.</th>
                <th>Company / Business Unit</th>
                <th>Name Of Vessel / Aircraft</th>
                <th>ETD</th>
                <th>ETA</th>
                <th>Vogaye No</th>
                <th>Total Item</th>
                <th style="white-space: nowrap;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($transaksi as $row)
            <tr style="vertical-align: middle">
                <td style="width: 8%">{{ $no++ }}</td>
                <td>{{ $row->from }}</td>
                <td>{{ $row->to }}</td>
                <td>{{ $row->serial }}</td>
                <td>{{ $row->company }}</td>
                <td>{{ $row->vessel }}</td>
                <td>{{ $row->etd }}</td>
                <td>{{ $row->eta }}</td>
                <td>{{ $row->vogaye }}</td>
                <td>{{ $row->item }}</td>
                <td style="white-space: nowrap;">
                    <a href="{{ url('/transaksi-keluar/'.encrypt_int($row->id_transaksi)) }}"
                        class="btn btn-warning btn-sm text-light">Edit</a>
                    <a href="javascript:;" onclick="deleteData('{{ encrypt_url($row->id_transaksi) }}')"
                        class="btn btn-danger btn-sm ms-1">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal add-->
<div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formadd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="companyadd" class="text-muted">Company / Business Unit</label>
                                <input type="text" class="form-control" id="companyadd"
                                    placeholder="input company / business unit" name="company">
                            </div>
                            <div class="form-group mb-3">
                                <label for="fromadd" class="text-muted">From Location Code</label>
                                <input type="text" class="form-control" id="fromadd"
                                    placeholder="input from location code" name="from">
                                <div id="errorfromadd" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="toadd" class="text-muted">To Location Code</label>
                                <input type="text" class="form-control" id="toadd" placeholder="input to location code"
                                    name="to">
                                <div id="errortoadd" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="serialadd" class="text-muted">Serial No</label>
                                <input type="text" class="form-control" id="serialadd" placeholder="input serial no."
                                    name="serial">
                                <div id="errorserialadd" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="vesseladd" class="text-muted">Name of vessel / aircraft</label>
                                <input type="text" class="form-control" id="vesseladd" placeholder="input vessel no."
                                    name="vessel">
                            </div>
                            <div class="form-group mb-3">
                                <label for="etdadd" class="text-muted">ETD</label>
                                <input type="text" class="form-control" id="etdadd" placeholder="input ETD" name="etd">
                            </div>
                            <div class="form-group mb-3">
                                <label for="etaadd" class="text-muted">ETA</label>
                                <input type="text" class="form-control" id="etaadd" placeholder="input ETA" name="eta">
                            </div>
                            <div class="form-group mb-3">
                                <label for="vogayeadd" class="text-muted">Vogaye No.</label>
                                <input type="text" class="form-control" id="vogayeadd" placeholder="input vogaye no."
                                    name="vogaye">
                            </div>
                        </div>
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
        $("#errorfromadd").html("");
        $("#errortoadd").html("");
        $("#errorserialadd").html("");
    
        const formdata = new FormData(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            url: "{{ route('transaksi-keluar.store') }}",
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
                        window.location.href = "/transaksi-keluar/"+response.id;
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
                    if (typeof errors.from !== 'undefined'){
                        $("#fromadd").attr('class', 'form-control is-invalid');
                        $("#errorfromadd").html(errors.from[0]);
                    }else{
                        $("#fromadd").attr('class', 'form-control');
                    } 
                    if (typeof errors.to !== 'undefined'){
                        $("#toadd").attr('class', 'form-control is-invalid');
                        $("#errortoadd").html(errors.to[0]);
                    }else{
                        $("#toadd").attr('class', 'form-control');
                    } 
                    if (typeof errors.serial !== 'undefined'){
                        $("#serialadd").attr('class', 'form-control is-invalid');
                        $("#errorserialadd").html(errors.serial[0]);
                    }else{
                        $("#serialadd").attr('class', 'form-control');
                    }
                }
            }
        });
        e.preventDefault();
    });

   

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
                    url: "{{ route('transaksi-keluar.destroy') }}",
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