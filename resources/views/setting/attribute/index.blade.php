@extends('layouts.admin.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.css') }}">

    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <x-navbarAdmin :notifications="$notifications"></x-navbarAdmin>
        <x-sidebarAdmin></x-sidebarAdmin>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>{{ __('Data Atribut') }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active">Dashboard</div>
                        <div class="breadcrumb-item active">General Setting</div>
                        <div class="breadcrumb-item">Atribut</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pb-3">
                    <div class="title-content">
                        <h2 class="section-title">Data Kategori Atribut</h2>
                        <p class="section-lead">
                            Pilih dan Tambah Data Kategori Atribut
                        </p>
                    </div>
                    <div class="action-content">
                        <a href="{{ url('/setting/attribute/addRelation') }}">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#relationModal">+ Tambah
                                Data</button>
                        </a>
                    </div>
                </div>



                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Tabel Kategori Atribut') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-relation">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Kategori</th>
                                            <th>Atribut Daftar Ulang</th>
                                            <th>Atribut SPP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($categoriesRelation as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $no++ }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->category_name }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-wrap">
                                                        @foreach ($item->attributes as $attribute)
                                                            <div class="mb-2 mx-1">
                                                                <button
                                                                    class="btn btn-primary">{{ $attribute->attribute_name }}</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-wrap">
                                                        @foreach ($item->credits as $credit)
                                                            <div class="mb-2 mx-1">
                                                                <button
                                                                    class="btn btn-warning">{{ $credit->credit_name }}</button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        {{-- <div class="text-warning mx-2 cursor-pointer" data-toggle="modal"
                                                            data-target="#categoryModal{{ $item->id }}">
                                                            <i class="fas fa-pen" title="Edit"></i>
                                                        </div> --}}
                                                        <div class="text-danger mx-2 cursor-pointer">
                                                            <form id="form-{{ $item->id }}"
                                                                action="{{ url('/setting/attribute/deleteRelation', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <i onclick="deleteRelation(event)" class="fas fa-trash-alt"
                                                                    title="Delete"></i>
                                                            </form>
                                                        </div>
                                                        <script>
                                                            function deleteRelation(event) {
                                                                event.preventDefault(); // Mencegah pengiriman form

                                                                var form = event.currentTarget.parentElement; // Mengakses elemen form terkait
                                                                var itemId = form.id.split('-')[1]; // Mendapatkan ID item dari ID form

                                                                Notiflix.Confirm.show(
                                                                    'Konfirmasi Hapus',
                                                                    'Apakah Anda yakin ingin menghapus atribut ini?',
                                                                    'Ya, Hapus',
                                                                    'Batal',
                                                                    function() {
                                                                        // Lanjutkan dengan pengiriman form jika pengguna setuju
                                                                        document.getElementById("form-" + itemId).submit();
                                                                    }
                                                                );
                                                            }
                                                        </script>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pb-3">
                    <div class="title-content">
                        <h2 class="section-title">Data Atribut Daftar Ulang</h2>
                        <p class="section-lead">
                            Pilih dan Tambah Data Atribut Daftar Ulang
                        </p>
                    </div>
                    <div class="action-content">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">+ Tambah
                            Data</button>
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Tabel Atribut Daftar Ulang') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-tagihan-vendor">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Atribut</th>
                                            <th>Harga Atribut</th>
                                            <th>Diubah pada</th>
                                            <th>Petugas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($attributes as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $item->attribute_name }}
                                                </td>
                                                <td>
                                                    Rp{{ number_format($item->attribute_price, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->updated_at->format('d F Y') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->users->name }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="text-warning mx-2 cursor-pointer" data-toggle="modal"
                                                            data-target="#exampleModal{{ $item->id }}">
                                                            <i class="fas fa-pen" title="Edit Harga"></i>
                                                        </div>
                                                        <div class="text-danger mx-2 cursor-pointer">
                                                            <i class="fas attribute-delete fa-trash-alt"
                                                                data-card-id="{{ $item->id }}" title="delete"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pb-3">
                    <div class="title-content">
                        <h2 class="section-title">Data Atribut SPP</h2>
                        <p class="section-lead">
                            Pilih dan Tambah Data Atribut SPP
                        </p>
                    </div>
                    <div class="action-content">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#creditModal">+ Tambah
                            Data</button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Tabel Atribut SPP') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-credit">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Atribut</th>
                                            <th>Harga Atribut</th>
                                            <th>Semester</th>
                                            <th>Diubah pada</th>
                                            <th>Petugas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($credits as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $item->credit_name }}
                                                </td>
                                                <td>
                                                    Rp{{ number_format($item->credit_price, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->semester }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->updated_at->format('d F Y') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->users->name }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="text-warning mx-2 cursor-pointer" data-toggle="modal"
                                                            data-target="#creditEdit{{ $item->id }}">
                                                            <i class="fas fa-pen" title="Edit Harga"></i>
                                                        </div>
                                                        <div class="text-danger mx-2 cursor-pointer">
                                                            <i class="fas credit-delete fa-trash-alt"
                                                                data-card-id="{{ $item->id }}" title="delete"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pb-3">
                    <div class="title-content">
                        <h2 class="section-title">Data Kategori</h2>
                        <p class="section-lead">
                            Pilih dan Tambah Data Kategori
                        </p>
                    </div>
                    <div class="action-content">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">+ Tambah
                            Data</button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Tabel Kategori') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-category">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th>Nama Kategori</th>
                                            <th>Diubah pada</th>
                                            <th>Petugas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $no++ }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->category_name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->updated_at->format('d F Y') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->users->name }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="text-warning mx-2 cursor-pointer" data-toggle="modal"
                                                            data-target="#categoryModal{{ $item->id }}">
                                                            <i class="fas fa-pen" title="Edit"></i>
                                                        </div>
                                                        <div class="text-danger mx-2 cursor-pointer">
                                                            <i class="fas category-delete fa-trash-alt"
                                                                data-card-id="{{ $item->id }}" title="Delete"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Development by Muhammad Afifudin</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Atribut Daftar Ulang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="attributeForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="attribute_name">Nama Atribut</label>
                            <input type="text" class="form-control" name="attribute_name" id="attribute_name"
                                placeholder="Topi/Dasi/Seragam" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="attribute_price">Harga (Tulis : 100000) </label>
                            <input type="number" class="form-control" name="attribute_price" id="attribute_price"
                                placeholder="100000">
                        </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="creditModal">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Atribut SPP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="creditForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="credit_name">Nama Atribut</label>
                            <input type="text" class="form-control" name="credit_name" id="credit_name"
                                placeholder="SPP Juni" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="credit_price">Harga (Tulis : 100000) </label>
                            <input type="number" class="form-control" name="credit_price" id="credit_price"
                                placeholder="80000">
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control select2" name="semester">
                                <option>-- Pilih Kategori --</option>
                                <option value="Genap">Genap</option>
                                <option value="Ganjil">Ganjil</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="categoryModal">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="categoryForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Nama Kategori</label>
                            <input type="text" class="form-control" name="category_name" id="category_name"
                                placeholder="Reguler" autofocus>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($attributes as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal{{ $item->id }}">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Attribute Daftar Ulang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="update-form" data-action="{{ url('/setting/attribute/update/' . $item->id) }} }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="attribute_name">Nama Atribut</label>
                                <input type="text" class="form-control" name="attribute_name" id="attribute_name"
                                    value="{{ $item->attribute_name }}">
                            </div>
                            <div class="form-group">
                                <label for="attribute_price">Harga </label>
                                <input type="number" class="form-control" name="attribute_price" id="attribute_price"
                                    value="{{ round($item->attribute_price) }}" autofocus>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($credits as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="creditEdit{{ $item->id }}">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Attribute SPP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="update-form" data-action="{{ url('/setting/credit/update/' . $item->id) }} }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="credit_name">Nama Atribut</label>
                                <input type="text" class="form-control" name="credit_name" id="credit_name"
                                    value="{{ $item->credit_name }}">
                            </div>
                            <div class="form-group">
                                <label for="credit_price">Harga </label>
                                <input type="number" class="form-control" name="credit_price" id="credit_price"
                                    value="{{ round($item->credit_price) }}" autofocus>
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control select2" name="semester">
                                    @if ($item->semester == 'Genap')
                                        <option value="Genap" selected>Genap</option>
                                        <option value="Ganjil">Ganjil</option>
                                    @elseif($item->semester == 'Ganjil')
                                        <option value="Genap">Genap</option>
                                        <option value="Ganjil" selected>Ganjil</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Category --}}
    @foreach ($categories as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="categoryModal{{ $item->id }}">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="update-form" data-action="{{ url('/setting/category/update/' . $item->id) }} }}"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category_name">Nama Kategori</label>
                                <input type="text" class="form-control" name="category_name" id="category_name"
                                    value="{{ $item->category_name }}" autofocus>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Notiflix.Notify.success("{{ session('success') }}", {
                    timeout: 6000
                });
            @endif
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateForms = document.querySelectorAll('.update-form');

            updateForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const formData = new FormData(form);

                    fetch(form.getAttribute('data-action'), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            Notiflix.Notify.success("Data Berhasil Diperbarui", {
                                timeout: 3000
                            });

                            location.reload();
                        })
                        .catch(error => {
                            Notiflix.Notify.failure('Error:', error);
                        });
                });
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const attributeForm = document.getElementById('attributeForm');
            attributeForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                const formData = new FormData(attributeForm);
                const attributeData = {};
                formData.forEach((value, key) => {
                    attributeData[key] = value;
                });

                try {
                    const response = await fetch(`/setting/attribute/add`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(attributeData)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        const errorMessages = Object.values(errorData.errors).join('\n');
                        Notiflix.Notify.failure(
                            'Field tidak boleh kosong atau nama sejenis telah digunakan');
                    } else {
                        Notiflix.Notify.success('Success:', 'Attribute created successfully.');
                        location.reload();
                    }
                } catch (error) {
                    Notiflix.Notify.failure('Error:',
                        'An error occurred while processing the request.');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const creditForm = document.getElementById('creditForm');
            creditForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                const formData = new FormData(creditForm);
                const creditData = {};
                formData.forEach((value, key) => {
                    creditData[key] = value;
                });

                try {
                    const response = await fetch(`/setting/credit/add`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(creditData)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        const errorMessages = Object.values(errorData.errors).join('\n');
                        Notiflix.Notify.failure(
                            'Field tidak boleh kosong atau nama sejenis telah digunakan');
                    } else {
                        Notiflix.Notify.success('Success:', 'credit created successfully.');
                        location.reload();
                    }
                } catch (error) {
                    Notiflix.Notify.failure('Error:',
                        'An error occurred while processing the request.');
                }
            });
        });

        const deleteAttribute = document.querySelectorAll('.attribute-delete');

        // Tambahkan event listener untuk setiap tombol "Hapus Data"
        deleteAttribute.forEach(button => {
            button.addEventListener('click', function() {
                const cardId = button.dataset.cardId;

                Notiflix.Confirm.show('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?', 'Ya',
                    'Batal',
                    function() {
                        fetch(`/setting/attribute/delete/${cardId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Tampilkan notifikasi sukses menggunakan Notiflix
                                Notiflix.Notify.success("Data Atribut berhasil dihapus.", {
                                    timeout: 3000 // Waktu dalam milidetik (3 detik dalam contoh ini)
                                });

                                // Refresh halaman saat ini
                                location.reload();
                            })
                            .catch(error => {
                                // Tampilkan notifikasi error menggunakan Notiflix
                                Notiflix.Notify.failure('Error:', error);
                            });
                    });
            });
        });

        const deleteCredit = document.querySelectorAll('.credit-delete');

        // Tambahkan event listener untuk setiap tombol "Hapus Data"
        deleteCredit.forEach(button => {
            button.addEventListener('click', function() {
                const cardId = button.dataset.cardId;

                Notiflix.Confirm.show('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?', 'Ya',
                    'Batal',
                    function() {
                        fetch(`/setting/credit/delete/${cardId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Tampilkan notifikasi sukses menggunakan Notiflix
                                Notiflix.Notify.success("Data Credit berhasil dihapus.", {
                                    timeout: 3000 // Waktu dalam milidetik (3 detik dalam contoh ini)
                                });

                                // Refresh halaman saat ini
                                location.reload();
                            })
                            .catch(error => {
                                // Tampilkan notifikasi error menggunakan Notiflix
                                Notiflix.Notify.failure('Error:', error);
                            });
                    });
            });
        });
    </script>

    {{-- Category Action --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap form input tahun
            const categoryForm = document.getElementById('categoryForm');

            // Tambahkan event listener untuk saat form disubmit
            categoryForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Ambil data dari form input tahun
                const formData = new FormData(categoryForm);
                const yearData = {};
                formData.forEach((value, key) => {
                    yearData[key] = value;
                });

                // Kirim permintaan AJAX ke endpoint untuk menyimpan data tahun baru
                fetch(`/setting/category/add`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(yearData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan notifikasi sukses menggunakan Notiflix
                        Notiflix.Notify.success("Data Atribut berhasil ditambahkan", {
                            timeout: 3000 // Waktu dalam milidetik (3 detik dalam contoh ini)
                        });

                        // Refresh halaman saat ini
                        location.reload();
                    })
                    .catch(error => {
                        // Tampilkan notifikasi error menggunakan Notiflix
                        Notiflix.Notify.failure('Error:', error);
                    });
            });
        });

        const deleteCategory = document.querySelectorAll('.category-delete');

        // Tambahkan event listener untuk setiap tombol "Hapus Data"
        deleteCategory.forEach(button => {
            button.addEventListener('click', function() {
                const cardId = button.dataset.cardId;

                Notiflix.Confirm.show('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?', 'Ya',
                    'Batal',
                    function() {
                        fetch(`/setting/category/delete/${cardId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Tampilkan notifikasi sukses menggunakan Notiflix
                                Notiflix.Notify.success("Data Kategori berhasil dihapus.", {
                                    timeout: 3000 // Waktu dalam milidetik (3 detik dalam contoh ini)
                                });

                                // Refresh halaman saat ini
                                location.reload();
                            })
                            .catch(error => {
                                // Tampilkan notifikasi error menggunakan Notiflix
                                Notiflix.Notify.failure('Error:', error);
                            });
                    });
            });
        });
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
