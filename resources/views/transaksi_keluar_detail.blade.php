@extends('main')
@section('content')
    <style>
        .judul {
            font-size: 14px;
        }
    </style>
    <form id="formsimpan">
        <input type="hidden" name="id" id="id" value="{{ encrypt_url($transaksi[0]->id_transaksi) }}">
        <div class="d-flex">
            <a href="{{ route('transaksi-keluar') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
            <button type="submit" id="btnsimpan" class="btn btn-primary ms-3"><i class="fas fa-save"></i> Simpan</button>
        </div>

        <div class="mt-4 row">
            <div class="col-md-3 mb-4">
                <div class="statistics-card">
                    <div class="form-group mb-3">
                        <label for="company" class="text-muted">Company / Business Unit</label>
                        <input type="text" class="form-control" id="company" name="company" value="{{ $transaksi[0]->company }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="from" class="text-muted">From Location Code</label>
                        <input type="text" class="form-control" id="from" name="from" value="{{ $transaksi[0]->from }}">
                        <div id="errorfrom" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="to" class="text-muted">To Location Code</label>
                        <input type="text" class="form-control" id="to" name="to" value="{{ $transaksi[0]->to }}">
                        <div id="errorto" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="serial" class="text-muted">Serial No</label>
                        <input type="text" class="form-control" id="serial" name="serial" value="{{ $transaksi[0]->serial }}">
                        <div id="errorserial" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="vessel" class="text-muted">Name of vessel / aircraft</label>
                        <input type="text" class="form-control" id="vessel" name="vessel" value="{{ $transaksi[0]->vessel }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="etd" class="text-muted">ETD</label>
                        <input type="text" class="form-control" id="etd" name="etd" value="{{ $transaksi[0]->etd }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="eta" class="text-muted">ETA</label>
                        <input type="text" class="form-control" id="eta" name="eta" value="{{ $transaksi[0]->eta }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="vogaye" class="text-muted">Vogaye No.</label>
                        <input type="text" class="form-control" id="vogaye" name="vogaye" value="{{ $transaksi[0]->vogaye }}">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="statistics-card mb-4">
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fas fa-plus"></i> Tambah Item</button>
                    <table id="table-item" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Vocab Number</th>
                                <th>Description</th>
                                <th>UOM</th>
                                <th>QTY</th>
                                <th>Order No.</th>
                                <th>Remaks</th>
                                <th style="white-space: nowrap;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($item as $row)
                                <tr style="vertical-align: middle">
                                    <td style="width: 8%">{{ $no++ }}</td>
                                    <td>{{ $row->stock_code }}</td>
                                    <td>{{ nl2br($row->description) }}</td>
                                    <td>{{ $row->uom }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>{{ $row->order_no }}</td>
                                    <td>{{ $row->remaks }}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="javascript:;" onclick="editData('{{ encrypt_url($row->id_item) }}')" class="btn btn-warning btn-sm text-light">Edit</a>
                                        <a href="javascript:;" onclick="deleteData('{{ encrypt_url($row->id_item) }}')" class="btn btn-danger btn-sm ms-1">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="statistics-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-1">
                                <div class="card-header bg-secondary">
                                    <p class="text-center text-light m-0 judul">Consignor</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2 mt-2">
                                        <label class="text-muted">Signature</label>
                                        <input type="text" class="form-control" id="consignorsignature" name="consignorsignature" value="{{ $transaksi[0]->consignor_signature }}">
                                        <div id="errorconsignorsignature" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="consignorempl" class="text-muted">Empl No.</label>
                                        <input type="text" class="form-control" id="consignorempl" name="consignorempl" value="{{ $transaksi[0]->consignor_empl }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="consignorname" class="text-muted">Name</label>
                                        <input type="text" class="form-control" id="consignorname" name="consignorname" value="{{ $transaksi[0]->consignor_name }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="consignordate" class="text-muted">Date</label>
                                        <input type="date" class="form-control" id="consignordate" name="consignordate" value="{{ $transaksi[0]->consignor_date }}">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-3">
                            <div class="card border-1">
                                <div class="card-header bg-secondary">
                                    <p class="text-center text-light m-0 judul">Consignee</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2 mt-2">
                                        <label class="text-muted">Signature</label>
                                        <input type="text" class="form-control" id="consigneesignature" name="consigneesignature" value="{{ $transaksi[0]->consignee_signature }}">
                                        <div id="errorconsigneesignature" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="consigneeempl" class="text-muted">Empl No.</label>
                                        <input type="text" class="form-control" id="consigneeempl" name="consigneeempl" value="{{ $transaksi[0]->consignee_empl }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="consigneename" class="text-muted">Name</label>
                                        <input type="text" class="form-control" id="consigneename" name="consigneename" value="{{ $transaksi[0]->consignee_name }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="consigneedate" class="text-muted">Date</label>
                                        <input type="date" class="form-control" id="consigneedate" name="consigneedate" value="{{ $transaksi[0]->consignee_date }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="card border-1">
                                <div class="card-header bg-secondary">
                                    <p class="text-center text-light m-0 judul">Posted to Stock Card By</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2 mt-2">
                                        <label class="text-muted">Signature</label>
                                        <input type="text" class="form-control" id="stockcardsignature" name="stockcardsignature" value="{{ $transaksi[0]->stock_card_signature }}">
                                        <div id="errorstockcardsignature" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="stockcardempl" class="text-muted">Empl No.</label>
                                        <input type="text" class="form-control" id="stockcardempl" name="stockcardempl" value="{{ $transaksi[0]->stock_card_empl }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="stockcardname" class="text-muted">Name</label>
                                        <input type="text" class="form-control" id="stockcardname" name="stockcardname" value="{{ $transaksi[0]->stock_card_name }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="stockcarddate" class="text-muted">Date</label>
                                        <input type="date" class="form-control" id="stockcarddate" name="stockcarddate" value="{{ $transaksi[0]->stock_card_date }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="card border-1">
                                <div class="card-header bg-secondary">
                                    <p class="text-center text-light m-0 judul">Posted to MMIS</p>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2 mt-2">
                                        <label class="text-muted">Signature</label>
                                        <input type="text" class="form-control" id="mmissignature" name="mmissignature" value="{{ $transaksi[0]->mmis_signature }}">
                                        <div id="errormmissignature" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="mmisempl" class="text-muted">Empl No.</label>
                                        <input type="text" class="form-control" id="mmisempl" name="mmisempl" value="{{ $transaksi[0]->mmis_empl }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="mmisname" class="text-muted">Name</label>
                                        <input type="text" class="form-control" id="mmisname" name="mmisname" value="{{ $transaksi[0]->mmis_name }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="mmisdate" class="text-muted">Date</label>
                                        <input type="date" class="form-control" id="mmisdate" name="mmisdate" value="{{ $transaksi[0]->mmis_date }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal add-->
    <div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formadd" enctype="multipart/form-data">
                    <input type="hidden" name="id_transaksi" id="id_transaksi" value="{{ encrypt_url($transaksi[0]->id_transaksi) }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="text-muted">Vocabulary Number</label>
                                    <select class="" name="vocab" id="vocabadd" required>
                                        <option value=""></option>
                                        @foreach ($barang as $row)
                                            <option value="{{ encrypt_url($row->id_stok) }}">{{ $row->stock_code }}</option>
                                        @endforeach
                                    </select>
                                    <div id="errorvocabadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-muted">Description</label>
                                    <textarea rows="4" class="form-control" id="descriptionadd" readonly></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-muted">QOH</label>
                                    <input type="text" class="form-control" id="qohadd" name="qoh" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="uomadd" class="text-muted">UOM</label>
                                    <input type="text" class="form-control" id="uomadd" placeholder="input UOM" name="uom" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qtyadd" class="text-muted">Quantity</label>
                                    <input type="int" class="form-control" id="qtyadd" placeholder="input quantity" name="qty" value="" required>
                                    <div id="errorqtyadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ordernoadd" class="text-muted">Order No.</label>
                                    <input type="text" class="form-control" id="ordernoadd" placeholder="input order no." name="orderno" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="remaksadd" class="text-muted">Remaks</label>
                                    <input type="text" class="form-control" id="remaksadd" placeholder="input remaks" name="remaks" value="">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formedit" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idedit">
                    <input type="hidden" name="idstok" id="idstok">
                    <input type="hidden" name="qtyold" id="qtyoldedit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="text-muted">Vocabulary Number</label>
                                    <input type="text" class="form-control" id="vocabedit" name="vocab" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-muted">Description</label>
                                    <textarea rows="4" class="form-control" id="descriptionedit" readonly></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-muted">QOH</label>
                                    <input type="text" class="form-control" id="qohedit" name="qoh" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="uomedit" class="text-muted">UOM</label>
                                    <input type="text" class="form-control" id="uomedit" placeholder="input UOM" name="uom" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qtyedit" class="text-muted">Quantity</label>
                                    <input type="int" class="form-control" id="qtyedit" placeholder="input quantity" name="qty" value="" required>
                                    <div id="errorqtyedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ordernoedit" class="text-muted">Order No.</label>
                                    <input type="text" class="form-control" id="ordernoedit" placeholder="input order no." name="orderno" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="remaksedit" class="text-muted">Remaks</label>
                                    <input type="text" class="form-control" id="remaksedit" placeholder="input remaks" name="remaks" value="">
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
        $('#table-item').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "",
                sSearch: "Cari"
            },
        });

        $(document).ready(function() {
            $("#vocabadd").select2({
                dropdownParent: $("#modaladd"),
                placeholder: "Vocabulary number",
                width: "100%",
                theme: 'bootstrap-5'

            });
        });

        $('#vocabadd').on('change', function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('stok-barang.detail') }}",
                dataType: 'json',
                data: {
                    id: this.value
                },
                success: function(response) {
                    if (response.status == "1") {
                        data = response.stok[0];
                        $("#descriptionadd").val(data.description);
                        $("#qohadd").val(data.qoh);
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
        });


        $("#formsimpan").submit(function(e) {
            $("#btnsimpan").prop('disabled', true);
            $("#errorfrom").html("");
            $("#errorto").html("");
            $("#errorserial").html("");

            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('transaksi-keluar.update') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btnsimpan").prop('disabled', false);
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
                    $("#btnsimpan").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined') {
                        let errors = response.responseJSON.errors;
                        if (typeof errors.from !== 'undefined') {
                            $("#from").attr('class', 'form-control is-invalid');
                            $("#errorfrom").html(errors.from[0]);
                        } else {
                            $("#from").attr('class', 'form-control');
                        }
                        if (typeof errors.to !== 'undefined') {
                            $("#to").attr('class', 'form-control is-invalid');
                            $("#errorto").html(errors.to[0]);
                        } else {
                            $("#to").attr('class', 'form-control');
                        }
                        if (typeof errors.serial !== 'undefined') {
                            $("#serial").attr('class', 'form-control is-invalid');
                            $("#errorserial").html(errors.serial[0]);
                        } else {
                            $("#serial").attr('class', 'form-control');
                        }
                        if (typeof errors.consignorsignature !== 'undefined') {
                            $("#consignorsignature").attr('class', 'form-control is-invalid');
                            $("#errorconsignorsignature").html(errors.serial[0]);
                        } else {
                            $("#consignorsignature").attr('class', 'form-control');
                        }
                        if (typeof errors.consigneesignature !== 'undefined') {
                            $("#consigneesignature").attr('class', 'form-control is-invalid');
                            $("#errorconsigneesignature").html(errors.serial[0]);
                        } else {
                            $("#consigneesignature").attr('class', 'form-control');
                        }
                        if (typeof errors.stockcardsignature !== 'undefined') {
                            $("#stockcardsignature").attr('class', 'form-control is-invalid');
                            $("#errorstockcardsignature").html(errors.serial[0]);
                        } else {
                            $("#stockcardsignature").attr('class', 'form-control');
                        }
                        if (typeof errors.mmissignature !== 'undefined') {
                            $("#mmissignature").attr('class', 'form-control is-invalid');
                            $("#errormmissignature").html(errors.serial[0]);
                        } else {
                            $("#mmissignature").attr('class', 'form-control');
                        }
                    }
                }
            });
            e.preventDefault();
        });

        $("#formadd").submit(function(e) {
            $("#btnadd").prop('disabled', true);
            $("#errorvocabadd").html("");
            $("#errorqty").html("");

            var qoh = parseInt($("#qohadd").val());
            var qty = parseInt($("#qtyadd").val());
            if (qty > qoh) {
                $("#qtyadd").attr('class', 'form-control is-invalid');
                $("#errorqtyadd").html("Quantity should not exceed QOH");
            } else {
                $("#qtyadd").attr('class', 'form-control');
                $("#errorqtyadd").html("");

                const formdata = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'post',
                    url: "{{ route('transaksi-keluar.store-item') }}",
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

                            if (typeof errors.qty !== 'undefined') {
                                $("#qtyadd").attr('class', 'form-control is-invalid');
                                $("#errorqtyadd").html(errors.qty[0]);
                            } else {
                                $("#qtyadd").attr('class', 'form-control');
                            }
                        }
                    }
                });
            }


            e.preventDefault();
        });

        function editData(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('transaksi-keluar.detail-item') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status == "1") {
                        data = response.item[0];
                        $("#idedit").val(id);
                        $("#vocabedit").val(data.stock_code);
                        $("#idstok").val(data.id_stok);
                        $("#descriptionedit").val(data.description);
                        $("#qohedit").val(data.qoh);
                        $("#uomedit").val(data.uom);
                        $("#qtyedit").val(data.qty);
                        $("#qtyoldedit").val(data.qty);
                        $("#ordernoedit").val(data.order_no);
                        $("#remaksedit").val(data.remaks);
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
            $("#errorvocabedit").html("");
            $("#errorqty").html("");

            var qoh = parseInt($("#qohedit").val());
            var qtyold = parseInt($("#qtyoldedit").val());
            var qty = parseInt($("#qtyedit").val());

            var sumqty = qty - qtyold;

            if (sumqty > qoh) {
                $("#qtyedit").attr('class', 'form-control is-invalid');
                $("#errorqtyedit").html("Quantity is not enough");
            } else {
                $("#qtyedit").attr('class', 'form-control');
                $("#errorqtyedit").html("");

                const formdata = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'post',
                    url: "{{ route('transaksi-keluar.update-item') }}",
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

                            if (typeof errors.qty !== 'undefined') {
                                $("#qtyedit").attr('class', 'form-control is-invalid');
                                $("#errorqtyedit").html(errors.qty[0]);
                            } else {
                                $("#qtyedit").attr('class', 'form-control');
                            }
                        }
                    }
                });
            }


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
                        url: "{{ route('transaksi-keluar.destroy-item') }}",
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
