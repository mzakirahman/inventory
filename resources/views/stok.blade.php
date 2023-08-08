@extends('main')
@section('content')
    <div class="statistics-card">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fas fa-plus"></i> Tambah Data</button>
        <table id="table-stok" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Stock Code</th>
                    <th>Description</th>
                    <th>QOH</th>
                    <th>Unit Value</th>
                    <th>Total Value</th>
                    <th>Location</th>
                    <th>Bin Loc</th>
                    <th class="text-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($stok as $row)
                    <tr style="vertical-align: middle">
                        <td style="width:6%">{{ $no++ }}</td>
                        <td>{{ $row->stock_code }}</td>
                        <td>{{ nl2br($row->description) }}</td>
                        <td>{{ number_format($row->qoh, 0, ',', '.') }}</td>
                        <td>{{ number_format($row->unit_value, 0, ',', '.') }}</td>
                        <td>{{ number_format($row->qoh * $row->unit_value, 0, ',', '.') }}</td>
                        <td>{{ $row->location }}</td>
                        <td>{{ $row->bin_loc }}</td>
                        <td class="text-nowrap">
                            <a href="javascript:;" onclick="editData('{{ encrypt_url($row->id_stok) }}')" class="btn btn-warning btn-sm text-light">Edit</a>
                            <a href="javascript:;" onclick="deleteData('{{ encrypt_url($row->id_stok) }}')" class="btn btn-danger btn-sm ms-1">Hapus</a>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Stok Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="formadd" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="codeadd" class="text-muted">Stock Code</label>
                                    <input type="text" class="form-control" id="codeadd" placeholder="input stock code" name="code">
                                    <div id="errorcodeadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="descriptionadd" class="text-muted">Description</label>
                                    <textarea name="description" id="descriptionadd" rows="4" class="form-control" placeholder="input description"></textarea>
                                    <div id="errordescriptionadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="locationadd" class="text-muted">Location</label>
                                    <input type="text" class="form-control" id="locationadd" placeholder="input location" name="location">
                                    <div id="errorlocationadd" class="invalid-feedback"></div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="qohadd" class="text-muted">QOH</label>
                                    <input type="number" class="form-control" id="qohadd" placeholder="input QOH" name="qoh">
                                    <div id="errorqohadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="unitvalueadd" class="text-muted">Unit Value</label>
                                    <input type="number" class="form-control" id="unitvalueadd" value="" placeholder="input unit value" name="unit_value">
                                    <div id="errorunitvalueadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="binlocadd" class="text-muted">Bin Loc</label>
                                    <input type="text" class="form-control" id="binlocadd" placeholder="input bin loc" name="bin_loc">
                                    <div id="errorbinlocadd" class="invalid-feedback"></div>
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

    <!-- Modal edit-->
    <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Stok Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formedit" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idedit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="codeedit" class="text-muted">Stock Code</label>
                                    <input type="text" class="form-control" id="codeedit" placeholder="input stock code" name="code">
                                    <div id="errorcodeedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="descriptionedit" class="text-muted">Description</label>
                                    <textarea name="description" id="descriptionedit" rows="4" class="form-control" placeholder="input description"></textarea>
                                    <div id="errordescriptionedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="locationedit" class="text-muted">Location</label>
                                    <input type="text" class="form-control" id="locationedit" placeholder="input location" name="location">
                                    <div id="errorlocationedit" class="invalid-feedback"></div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="qohedit" class="text-muted">QOH</label>
                                    <input type="number" class="form-control" id="qohedit" placeholder="input QOH" name="qoh">
                                    <div id="errorqohedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="unitvalueedit" class="text-muted">Unit Value</label>
                                    <input type="number" class="form-control" id="unitvalueedit" value="" placeholder="input unit value" name="unit_value">
                                    <div id="errorunitvalueedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="binlocedit" class="text-muted">Bin Loc</label>
                                    <input type="text" class="form-control" id="binlocedit" placeholder="input bin loc" name="bin_loc">
                                    <div id="errorbinlocedit" class="invalid-feedback"></div>
                                </div>
                            </div>
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
        $('#table-stok').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "",
                sSearch: "Cari"
            },
        });

        $("#formadd").submit(function(e) {
            $("#btnadd").prop('disabled', true);
            $("#errorcodeadd").html("");
            $("#errordescriptionadd").html("");
            $("#errorqohadd").html("");
            $("#errorlocationadd").html("");
            $("#errorbinlocadd").html("");
            $("#errorunitvalueadd").html("");
            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('stok-barang.store') }}",
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
                    } else if (response.status == "00") {
                        $("#codeadd").attr('class', 'form-control is-invalid');
                        $("#errorcodeadd").html("Code sudah digunakan!");
                    } else {
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
                    if (typeof response.responseJSON.errors !== 'undefined') {
                        let errors = response.responseJSON.errors;
                        if (typeof errors.code !== 'undefined') {
                            $("#codeadd").attr('class', 'form-control is-invalid');
                            $("#errorcodeadd").html(errors.code[0]);
                        } else {
                            $("#codeadd").attr('class', 'form-control');
                        }
                        if (typeof errors.description !== 'undefined') {
                            $("#descriptionadd").attr('class', 'form-control is-invalid');
                            $("#errordescriptionadd").html(errors.description[0]);
                        } else {
                            $("#descriptionadd").attr('class', 'form-control');
                        }
                        if (typeof errors.qoh !== 'undefined') {
                            $("#qohadd").attr('class', 'form-control is-invalid');
                            $("#errorqohadd").html(errors.qoh[0]);
                        } else {
                            $("#qohadd").attr('class', 'form-control');
                        }
                        if (typeof errors.unit_value !== 'undefined') {
                            $("#unitvalueadd").attr('class', 'form-control is-invalid');
                            $("#errorunitvalueadd").html(errors.unit_value[0]);
                        } else {
                            $("#unitvalueadd").attr('class', 'form-control');
                        }
                        if (typeof errors.location !== 'undefined') {
                            $("#locationadd").attr('class', 'form-control is-invalid');
                            $("#errorlocationadd").html(errors.location[0]);
                        } else {
                            $("#locationadd").attr('class', 'form-control');
                        }

                        if (typeof errors.bin_loc !== 'undefined') {
                            $("#binlocadd").attr('class', 'form-control is-invalid');
                            $("#errorbinlocadd").html(errors.bin_loc[0]);
                        } else {
                            $("#binlocadd").attr('class', 'form-control');
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
                url: "{{ route('stok-barang.detail') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status == "1") {
                        data = response.stok[0];
                        $("#idedit").val(id);
                        $("#codeedit").val(data.stock_code);
                        $("#descriptionedit").val(data.description);
                        $("#qohedit").val(data.qoh);
                        $("#locationedit").val(data.location);
                        $("#unitvalueedit").val(data.unit_value);
                        $("#binlocedit").val(data.bin_loc);
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
            $("#errorcodeedit").html("");
            $("#errordescriptionedit").html("");
            $("#errorqohedit").html("");
            $("#errorlocationedit").html("");
            $("#errorbinlocedit").html("");
            $("#errorunitvalueedit").html("");

            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('stok-barang.update') }}",
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
                    } else if (response.status == "00") {
                        $("#codeedit").attr('class', 'form-control is-invalid');
                        $("#errorcodeedit").html("Code sudah digunakan!");
                    } else {
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
                    if (typeof response.responseJSON.errors !== 'undefined') {
                        let errors = response.responseJSON.errors;
                        if (typeof errors.code !== 'undefined') {
                            $("#codeedit").attr('class', 'form-control is-invalid');
                            $("#errorcodeedit").html(errors.code[0]);
                        } else {
                            $("#codeedit").attr('class', 'form-control');
                        }
                        if (typeof errors.description !== 'undefined') {
                            $("#descriptionedit").attr('class', 'form-control is-invalid');
                            $("#errordescriptionedit").html(errors.description[0]);
                        } else {
                            $("#descriptionedit").attr('class', 'form-control');
                        }
                        if (typeof errors.qoh !== 'undefined') {
                            $("#qohedit").attr('class', 'form-control is-invalid');
                            $("#errorqohedit").html(errors.qoh[0]);
                        } else {
                            $("#qohedit").attr('class', 'form-control');
                        }
                        if (typeof errors.unit_value !== 'undefined') {
                            $("#unitvalueedit").attr('class', 'form-control is-invalid');
                            $("#errorunitvalueedit").html(errors.unit_value[0]);
                        } else {
                            $("#unitvalueedit").attr('class', 'form-control');
                        }
                        if (typeof errors.location !== 'undefined') {
                            $("#locationedit").attr('class', 'form-control is-invalid');
                            $("#errorlocationedit").html(errors.location[0]);
                        } else {
                            $("#locationedit").attr('class', 'form-control');
                        }

                        if (typeof errors.bin_loc !== 'undefined') {
                            $("#binlocedit").attr('class', 'form-control is-invalid');
                            $("#errorbinlocedit").html(errors.bin_loc[0]);
                        } else {
                            $("#binlocedit").attr('class', 'form-control');
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
                        url: "{{ route('stok-barang.destroy') }}",
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
