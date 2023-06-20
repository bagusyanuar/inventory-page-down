@extends('layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Barang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Barang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="text-right mb-2">
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i
                            class="fa fa-plus mr-1"></i><span
                            class="font-weight-bold">Tambah</span></a>
                </div>
            </div>
            <div class="card-body">
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="20%">Jenis Barang</th>
                        <th width="13%">Warna</th>
                        <th width="30%">Nama Barang</th>
                        <th width="12%">Ukuran</th>
                        <th width="12%">Qty</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group w-100 mb-1">
                        <label for="jenis_barang">Jenis Barang</label>
                        <select class="form-control" id="jenis_barang" name="jenis_barang">
                            <option value="">--pilih jenis barang--</option>
                            @foreach($jenis_barang as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group w-100 mb-1">
                        <label for="warna">Warna</label>
                        <select class="form-control" id="warna" name="warna">
                            <option value="">--pilih warna--</option>
                            @foreach($warna as $w)
                                <option value="{{ $w->id }}">{{ $w->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 mb-1">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama Barang"
                               name="nama">
                    </div>
                    <div class="form-group w-100 mb-1">
                        <label for="ukuran">Ukuran</label>
                        <select class="form-control" id="ukuran" name="ukuran">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="btn-save" type="button" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                    <div class="form-group w-100 mb-1">
                        <label for="jenis_barang_edit">Jenis Barang</label>
                        <select class="form-control" id="jenis_barang_edit" name="jenis_barang_edit">
                            <option value="">--pilih jenis barang--</option>
                            @foreach($jenis_barang as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group w-100 mb-1">
                        <label for="warna_edit">Warna</label>
                        <select class="form-control" id="warna_edit" name="warna_edit">
                            <option value="">--pilih warna--</option>
                            @foreach($warna as $w)
                                <option value="{{ $w->id }}">{{ $w->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 mb-1">
                        <label for="nama_edit" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_edit" placeholder="Nama Barang"
                               name="nama_edit">
                    </div>
                    <div class="form-group w-100 mb-1">
                        <label for="ukuran_edit">Ukuran</label>
                        <select class="form-control" id="ukuran_edit" name="ukuran_edit">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="XXXL">XXXL</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="btn-patch" type="button" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;

        function clear() {
            $('#jenis_barang').val('');
            $('#warna').val('');
            $('#nama').val('');
            $('#ukuran').val('S');
            $('#jenis_barang_edit').val('');
            $('#warna_edit').val('');
            $('#nama_edit').val('');
            $('#ukuran_edit').val('S');
            $('#id').val('');
        }

        function store() {
            let url = '{{ route('barang') }}';
            let data = {
                jenis_barang: $('#jenis_barang').val(),
                warna: $('#warna').val(),
                nama: $('#nama').val(),
                ukuran: $('#ukuran').val(),
            };
            AjaxPost(url, data, function () {
                clear();
                SuccessAlert('Berhasil!', 'Berhasil menyimpan data...');
                reload();
            });
        }

        function patch() {
            let id = $('#id').val();
            let url = '{{ route('barang') }}' + '/' + id;
            let data = {
                jenis_barang: $('#jenis_barang_edit').val(),
                warna: $('#warna_edit').val(),
                nama: $('#nama_edit').val(),
                ukuran: $('#ukuran_edit').val(),
            };
            AjaxPost(url, data, function () {
                clear();
                SuccessAlert('Berhasil!', 'Berhasil merubah data...');
                reload();
            });
        }

        function destroy(id) {
            let url = '{{ route('barang') }}' + '/' + id + '/delete';
            AjaxPost(url, {}, function () {
                clear();
                SuccessAlert('Berhasil!', 'Berhasil menghapus data...');
                reload();
            });
        }

        function reload() {
            table.ajax.reload();
        }

        function editEvent() {
            $('.btn-edit').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let jenis_barang = this.dataset.jenis;
                let warna = this.dataset.warna;
                let ukuran = this.dataset.ukuran;
                let name = this.dataset.name;
                $('#jenis_barang_edit').val(jenis_barang);
                $('#warna_edit').val(warna);
                $('#ukuran_edit').val(ukuran);
                $('#nama_edit').val(name);
                $('#id').val(id);
                $('#modalEdit').modal('show');
            })
        }


        function deleteEvent() {
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menghapus data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        destroy(id);
                    }
                });

            })
        }

        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/barang', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'jenis_barang.nama'},
                {data: 'warna.nama'},
                {data: 'nama'},
                {data: 'ukuran'},
                {data: 'qty'},
                {
                    data: null, render: function (data) {
                        return '<a href="#" class="btn btn-sm btn-warning btn-edit mr-1" data-id="' + data['id'] + '" data-ukuran="' + data['ukuran'] + '" data-warna="' + data['warna_id'] + '" data-jenis="' + data['jenis_barang_id'] + '" data-name="' + data['nama'] + '"><i class="fa fa-edit f12"></i></a>' +
                            '<a href="#" class="btn btn-sm btn-danger btn-delete" data-id="' + data['id'] + '"><i class="fa fa-trash f12"></i></a>';
                    }
                },
            ], [
                {
                    targets: [0, 2, 4, 5, 6],
                    className: 'text-center'
                },
            ], function (d) {
            }, {
                "fnDrawCallback": function (setting) {
                    editEvent();
                    deleteEvent();
                }
            });

            $('#btn-save').on('click', function () {
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        store();
                    }
                });
            });
            $('#btn-patch').on('click', function () {
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin merubah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        patch();
                    }
                });
            });
            deleteEvent();
            $('#modalAdd').on('hidden.bs.modal', function (e) {
                clear();
            });
            $('#modalEdit').on('hidden.bs.modal', function (e) {
                clear();
            })
        });
    </script>
@endsection
