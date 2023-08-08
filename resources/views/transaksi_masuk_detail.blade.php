@extends('main')
@section('content')
    <form id="formsimpan">
        <input type="hidden" name="id" id="id" value="{{ encrypt_url($transaksi[0]->id_transaksi) }}">
        <div class="statistics-card mt-4 mb-4">
            <div class="mb-4 row">
                <div class="col-md-9">
                    <a href="{{ route('transaksi-masuk') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                    <button type="submit" id="btnsimpan" class="btn btn-success ms-1"><i class="fas fa-save"></i>
                        Simpan</button>
                    <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fas fa-plus"></i> Tambah Item</button>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-2 d-flex">
                            <label class="text-muted my-auto">No</label>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" id="no" name="no" value="{{ $transaksi[0]->no }}">
                            <div id="errorno" class="invalid-feedback"></div>
                        </div>
                        <div class="col-2 mt-2 d-flex">
                            <label class="text-muted my-auto">Date</label>
                        </div>
                        <div class="col-10 mt-2">
                            <input type="date" class="form-control" id="datetransaksi" name="datetransaksi" value="{{ $transaksi[0]->date_transaksi }}">
                            <div id="errordate" class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>

            <table id="table-item" class="table mb-4" style="width:100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>PO Number</th>
                        <th>Stock Code</th>
                        <th>Description</th>
                        <th>UOI</th>
                        <th>QTY On Hand</th>
                        <th>QTY Received</th>
                        <th>QTY Balance</th>
                        <th class="hide-col">Min/Max</th>
                        <th class="hide-col">Bin Loc</th>
                        <th class="hide-col">Doc Loc</th>
                        <th class="hide-col">Remarks</th>
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
                            <td>{{ $row->po_number }}</td>
                            <td>{{ $row->stock_code }}</td>
                            <td>{{ nl2br($row->description) }}</td>
                            <td>{{ $row->uoi }}</td>
                            <td>{{ $row->on_hand }}</td>
                            <td>{{ $row->received }}</td>
                            <td>{{ $row->balance }}</td>
                            <td>{{ $row->min_max }}</td>
                            <td>{{ $row->bin_loc }}</td>
                            <td>{{ $row->doc_loc }}</td>
                            <td>{{ $row->remarks }}</td>
                            <td style="white-space: nowrap;">
                                <a href="javascript:;" onclick="editData('{{ encrypt_url($row->id_item) }}')" class="btn btn-warning btn-sm text-light">Edit</a>
                                <a href="javascript:;" onclick="deleteData('{{ encrypt_url($row->id_item) }}')" class="btn btn-danger btn-sm ms-1">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 row">
                <div class="col-md-6">
                    <div class="card border-1">
                        <div class="card-header bg-secondary">
                            <p class="text-center text-light m-0">Receiving Section</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2 mt-2">
                                        <label for="receivedfrom" class="text-muted">Received From</label>
                                        <input type="text" class="form-control" id="receivedfrom" name="receivedfrom" value="{{ $transaksi[0]->carried_by }}">
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="carriedby" class="text-muted">Carried By</label>
                                        <input type="text" class="form-control" id="carriedby" name="carriedby" value="{{ $transaksi[0]->carried_by }}">
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="checkedby" class="text-muted">Checked By</label>
                                        <input type="text" class="form-control" id="checkedby" name="checkedby" value="{{ $transaksi[0]->carried_by }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="position" class="text-muted">Position</label>
                                        <input type="text" class="form-control" id="position" name="position" value="{{ $transaksi[0]->position }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="date" class="text-muted">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ $transaksi[0]->date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2 mt-2">
                                        <label class="text-muted">Signature</label>
                                        <input type="text" class="form-control" id="receivingsignature" name="receivingsignature" value="{{ $transaksi[0]->receiving_signature }}">
                                        <div id="errorreceivingsignature" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="receivingname" class="text-muted">Name</label>
                                        <input type="text" class="form-control" id="receivingname" name="receivingname" value="{{ $transaksi[0]->receiving_name }}">
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="receivingposition" class="text-muted">Position</label>
                                        <input type="text" class="form-control" id="receivingposition" name="receivingposition" value="{{ $transaksi[0]->receiving_position }}">
                                    </div>
                                    <div class="form-group mb-2 mt-2">
                                        <label for="receivingempl" class="text-muted">Empl No.</label>
                                        <input type="text" class="form-control" id="receivingempl" name="receivingempl" value="{{ $transaksi[0]->receiving_empl }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="receivingdate" class="text-muted">Date</label>
                                        <input type="date" class="form-control" id="receivingdate" name="receivingdate" value="{{ $transaksi[0]->receiving_date }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card border-1">
                        <div class="card-header bg-secondary">
                            <p class="text-center text-light m-0">Inventory Section</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2 mt-2">
                                <label class="text-muted">Signature</label>
                                <input type="text" class="form-control" id="inventorysignature" name="inventorysignature" value="{{ $transaksi[0]->inventory_signature }}">
                                <div id="errorinventorysignature" class="invalid-feedback"></div>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label for="inventoryname" class="text-muted">Name</label>
                                <input type="text" class="form-control" id="inventoryname" name="inventoryname" value="{{ $transaksi[0]->inventory_name }}">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label for="inventoryposition" class="text-muted">Position</label>
                                <input type="text" class="form-control" id="inventoryposition" name="inventoryposition" value="{{ $transaksi[0]->inventory_position }}">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label for="inventoryempl" class="text-muted">Empl No.</label>
                                <input type="text" class="form-control" id="inventoryempl" name="inventoryempl" value="{{ $transaksi[0]->inventory_empl }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="inventorydate" class="text-muted">Date</label>
                                <input type="date" class="form-control" id="inventorydate" name="inventorydate" value="{{ $transaksi[0]->inventory_date }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-1">
                        <div class="card-header bg-secondary">
                            <p class="text-center text-light m-0">Record By</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2 mt-2">
                                <label class="text-muted">Signature</label>
                                <input type="text" class="form-control" id="recordsignature" name="recordsignature" value="{{ $transaksi[0]->record_signature }}">
                                <div id="errorrecordsignature" class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label for="recordname" class="text-muted">Name</label>
                                <input type="text" class="form-control" id="recordname" name="recordname" value="{{ $transaksi[0]->record_name }}">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label for="recordposition" class="text-muted">Position</label>
                                <input type="text" class="form-control" id="recordposition" name="recordposition" value="{{ $transaksi[0]->record_position }}">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label for="recordempl" class="text-muted">Empl No.</label>
                                <input type="text" class="form-control" id="recordempl" name="recordempl" value="{{ $transaksi[0]->record_empl }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="recorddate" class="text-muted">Date</label>
                                <input type="date" class="form-control" id="recorddate" name="recorddate" value="{{ $transaksi[0]->record_date }}">
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
                                    <label class="text-muted">Stock Code</label>
                                    <select class="" name="code" id="codeadd" required>
                                        <option value=""></option>
                                        @foreach ($barang as $row)
                                            <option value="{{ encrypt_url($row->id_stok) }}">{{ $row->stock_code }}</option>
                                        @endforeach
                                    </select>
                                    <div id="errorcodeadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-muted">Description</label>
                                    <textarea rows="4" class="form-control" id="descriptionadd" readonly></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="poadd" class="text-muted">PO Number</label>
                                    <input type="text" class="form-control" id="poadd" placeholder="input PO number" name="po" value="">
                                    <div id="errorpoadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="uoiadd" class="text-muted">UOI</label>
                                    <input type="text" class="form-control" id="uoiadd" placeholder="input UOI" name="uoi" value="">
                                    <div id="erroruoiadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="handadd" class="text-muted">Quantity On Hand</label>
                                    <input type="number" class="form-control" id="handadd" placeholder="input quantity on hand" name="hand" value="" onkeydown="balanceAdd()" onkeyup="balanceAdd()">
                                    <div id="errorhandadd" class="invalid-feedback"></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="receivedadd" class="text-muted">Quantity Received</label>
                                    <input type="number" class="form-control" id="receivedadd" placeholder="input quantity received" name="received" value="" required onkeydown="balanceAdd()" onkeyup="balanceAdd()">
                                    <div id="errorreceivedadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="balanceadd" class="text-muted">Quantity Balance</label>
                                    <input type="number" class="form-control" id="balanceadd" placeholder="input quantity balance" name="balance" value="0" readonly>
                                    <div id="errorbalanceadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="minadd" class="text-muted">Min / Max</label>
                                    <input type="int" class="form-control" id="minadd" placeholder="input min/max" name="min" value="">
                                    <div id="errorminadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="binadd" class="text-muted">Bin Loc</label>
                                    <input type="int" class="form-control" id="binadd" placeholder="input bin loc" name="bin" value="">
                                    <div id="errorbinadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="docadd" class="text-muted">Doc Loc</label>
                                    <input type="int" class="form-control" id="docadd" placeholder="input doc loc" name="doc" value="">
                                    <div id="errordocadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="remarksadd" class="text-muted">Remarks</label>
                                    <input type="int" class="form-control" id="remarksadd" placeholder="input remarks loc" name="remarks" value="">
                                    <div id="errorremarksadd" class="invalid-feedback"></div>
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
                    <input type="hidden" name="receivedold" id="receivedoldedit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="text-muted">Stock Code</label>
                                    <input type="text" class="form-control" id="codeedit" readonly>
                                    <div id="errorcodeadd" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-muted">Description</label>
                                    <textarea rows="4" class="form-control" id="descriptionedit" readonly></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="poedit" class="text-muted">PO Number</label>
                                    <input type="text" class="form-control" id="poedit" placeholder="input PO number" name="po" value="">
                                    <div id="errorpoedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="uoiedit" class="text-muted">UOI</label>
                                    <input type="text" class="form-control" id="uoiedit" placeholder="input UOI" name="uoi" value="">
                                    <div id="erroruoiedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="handedit" class="text-muted">Quantity On Hand</label>
                                    <input type="text" class="form-control" id="handedit" placeholder="input quantity on hand" name="hand" value="" onkeydown="balanceEdit()" onkeyup="balanceEdit()">
                                    <div id="errorhandedit" class="invalid-feedback"></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="receivededit" class="text-muted">Quantity Received</label>
                                    <input type="number" class="form-control" id="receivededit" placeholder="input quantity received" name="received" value="" required onkeydown="balanceEdit()" onkeyup="balanceEdit()">
                                    <div id="errorreceivededit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="balanceedit" class="text-muted">Quantity Balance</label>
                                    <input type="number" class="form-control" id="balanceedit" placeholder="input quantity balance" name="balance" value="" readonly>
                                    <div id="errorbalanceedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="minedit" class="text-muted">Min / Max</label>
                                    <input type="int" class="form-control" id="minedit" placeholder="input min/max" name="min" value="">
                                    <div id="errorminedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="binedit" class="text-muted">Bin Loc</label>
                                    <input type="int" class="form-control" id="binedit" placeholder="input bin loc" name="bin" value="">
                                    <div id="errorbinedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="docedit" class="text-muted">Doc Loc</label>
                                    <input type="int" class="form-control" id="docedit" placeholder="input doc loc" name="doc" value="">
                                    <div id="errordocedit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="remarksedit" class="text-muted">Remarks</label>
                                    <input type="int" class="form-control" id="remarksedit" placeholder="input remarks loc" name="remarks" value="">
                                    <div id="errorremarksedit" class="invalid-feedback"></div>
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
            aoColumnDefs: [{
                "sClass": "hide-col",
                "aTargets": [8, 9, 10, 11]
            }],
        });

        $(document).ready(function() {
            $("#codeadd").select2({
                dropdownParent: $("#modaladd"),
                placeholder: "Stock Code",
                width: "100%",
                theme: 'bootstrap-5'

            });
        });

        function balanceAdd() {
            var onhand = 0;
            var received = 0;
            if ($("#handadd").val() != "") {
                onhand = parseFloat($("#handadd").val());
            }
            if ($("#receivedadd").val() != "") {
                received = parseFloat($("#receivedadd").val());
            }

            var balance = onhand + received;
            $("#balanceadd").val(balance);
        }

        function balanceEdit() {
            var onhand = 0;
            var received = 0;
            if ($("#handedit").val() != "") {
                onhand = parseFloat($("#handedit").val());
            }
            if ($("#receivededit").val() != "") {
                received = parseFloat($("#receivededit").val());
            }

            var balance = onhand + received;
            $("#balanceedit").val(balance);
        }

        $('#codeadd').on('change', function() {
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
                        $("#handadd").val(data.qoh);
                        $("#binadd").val(data.bin_loc);
                        balanceAdd();
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
                url: "{{ route('transaksi-masuk.update') }}",
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
                        if (typeof errors.no !== 'undefined') {
                            $("#no").attr('class', 'form-control is-invalid');
                            $("#errorno").html(errors.no[0]);
                        } else {
                            $("#no").attr('class', 'form-control');
                        }
                        if (typeof errors.date !== 'undefined') {
                            $("#date").attr('class', 'form-control is-invalid');
                            $("#errordate").html(errors.date[0]);
                        } else {
                            $("#date").attr('class', 'form-control');
                        }
                        if (typeof errors.receivingsignature !== 'undefined') {
                            $("#receivingsignature").attr('class', 'form-control is-invalid');
                            $("#errorreceivingsignature").html(errors.date[0]);
                        } else {
                            $("#receivingsignature").attr('class', 'form-control');
                        }
                        if (typeof errors.inventorysignature !== 'undefined') {
                            $("#inventorysignature").attr('class', 'form-control is-invalid');
                            $("#errorinventorysignature").html(errors.date[0]);
                        } else {
                            $("#inventorysignature").attr('class', 'form-control');
                        }
                        if (typeof errors.recordsignature !== 'undefined') {
                            $("#recordsignature").attr('class', 'form-control is-invalid');
                            $("#errorrecordsignature").html(errors.date[0]);
                        } else {
                            $("#recordsignature").attr('class', 'form-control');
                        }
                    }
                }
            });
            e.preventDefault();
        });

        $("#formadd").submit(function(e) {
            $("#btnadd").prop('disabled', true);
            $("#errorcodeadd").html("");
            $("#errorreceivedadd").html("");

            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('transaksi-masuk.store-item') }}",
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
                        if (typeof errors.received !== 'undefined') {
                            $("#receivedadd").attr('class', 'form-control is-invalid');
                            $("#errorreceivedadd").html(errors.received[0]);
                        } else {
                            $("#receivedadd").attr('class', 'form-control');
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
                url: "{{ route('transaksi-masuk.detail-item') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status == "1") {
                        data = response.item[0];
                        $("#idedit").val(id);
                        $("#codeedit").val(data.stock_code);
                        $("#idstok").val(data.id_stok);
                        $("#descriptionedit").val(data.description);
                        $("#poedit").val(data.po_number);
                        $("#uoiedit").val(data.uoi);
                        $("#handedit").val(data.on_hand);
                        $("#receivedoldedit").val(data.received);
                        $("#receivededit").val(data.received);
                        $("#minedit").val(data.min_max);
                        $("#binedit").val(data.bin_loc);
                        $("#docedit").val(data.doc_loc);
                        $("#remarksedit").val(data.remarks);
                        balanceEdit();
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
            $("#errorreceivededit").html("");


            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('transaksi-masuk.update-item') }}",
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

                        if (typeof errors.received !== 'undefined') {
                            $("#receivededit").attr('class', 'form-control is-invalid');
                            $("#errorreceivededit").html(errors.received[0]);
                        } else {
                            $("#receivededit").attr('class', 'form-control');
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
                        url: "{{ route('transaksi-masuk.destroy-item') }}",
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
