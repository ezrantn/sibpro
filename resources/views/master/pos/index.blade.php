@extends('layouts.admin.app')

@section('title_page', 'POS Income')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    @endpush

    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <x-navbarAdmin :notifications="$notifications"></x-navbarAdmin>
        <x-sidebarAdmin :students="$students"></x-sidebarAdmin>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>{{ __('Data POS') }}</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item">{{ __('Dashboard') }}</div>
                        <div class="breadcrumb-item">{{ __('Master Data') }}</div>
                        <div class="breadcrumb-item active">{{ __('Point Of Sales') }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <div class="title-content">
                        <h2 class="section-title">{{ __('Master Data POS') }}</h2>
                        <p class="section-lead">
                            {{ __('Pilih dan Tambah Master Data POS') }}
                        </p>
                    </div>
                    <div class="action-content">
                        @can('access-classAdd')
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#AddModal">{{ __('+ Tambah Data') }}</button>
                        @endcan
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Tabel POS') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-tagihan-vendor">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">
                                                {{ __('No') }}
                                            </th>
                                            <th>{{ __('Kode POS') }}</th>
                                            <th>{{ __('Sumber POS') }}</th>
                                            <th>{{ __('Rincian POS') }}</th>
                                            <th>{{ __('Diubah Pada') }}</th>
                                            <th>{{ __('Aksi') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($poses as $item)
                                            <tr>
                                                <td>
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    {{ $item->point_code }}
                                                </td>
                                                <td>
                                                    {{ $item->point_source }}
                                                </td>
                                                <td>
                                                    {{ $item->point_name }}
                                                </td>
                                                <td>
                                                    {{ $item->updated_at->format('d F Y') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        @can('access-classUpdate')
                                                            <div class="text-warning mx-2 cursor-pointer" data-toggle="modal"
                                                                data-target="#updateModal{{ $item->id }}">
                                                                <i class="fas fa-pen" title="Edit Nama Kelas"></i>
                                                            </div>
                                                        @endcan
                                                        @can('access-classDelete')
                                                            <div class="text-danger mx-2 cursor-pointer">
                                                                <i class="fas class-delete fa-trash-alt"
                                                                    data-card-id="{{ $item->id }}"
                                                                    title="Delete Kelas"></i>
                                                            </div>
                                                        @endcan
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
                {{ __('Development by Muhammad Afifudin') }}</a>
            </div>
        </footer>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="AddModal">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data POS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="classForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pos_code">Kode POS</label>
                            <input type="text" class="form-control" name="point_code" id="point_code"
                                placeholder="Masukkan kode POS" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="point_source">Sumber Pos POS</label>
                            <input type="text" class="form-control" name="point_source" id="point_source"
                                placeholder="Masukkan sumber pendanaan">
                        </div>
                        <div class="form-group">
                            <label for="point_name">Rincian POS</label>
                            <input type="text" class="form-control" name="point_name" id="point_name"
                                placeholder="Masukkan rincian POS">
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


    @can('access-classUpdate')
        @foreach ($poses as $item)
            <div class="modal fade" tabindex="-1" role="dialog" id="updateModal{{ $item->id }}">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Data POS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="update-form" data-action="{{ url('/master/pos/update/' . $item->id) }} }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="pos_code">Kode POS</label>
                                    <input type="text" class="form-control" name="point_code" id="point_code"
                                        value="{{ $item->point_code }}">
                                </div>
                                <div class="form-group">
                                    <label for="point_source">Sumber Pos POS</label>
                                    <input type="text" class="form-control" name="point_source" id="point_source"
                                        value="{{ $item->point_source }}">
                                </div>
                                <div class="form-group">
                                    <label for="point_name">Rincian POS</label>
                                    <input type="text" class="form-control" name="point_name" id="point_name"
                                        value="{{ $item->point_name }}">
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
    @endcan

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const classForm = document.getElementById('classForm');
                classForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(classForm);
                    const classData = {};
                    formData.forEach((value, key) => {
                        classData[key] = value;
                    });
                    fetch(`/master/pos/add`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(classData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            Notiflix.Notify.success("Data pos berhasil dibuat!", {
                                timeout: 3000
                            });
                            location.reload();
                        })
                        .catch(error => {
                            Notiflix.Notify.failure('Error:', error);
                        });
                });
            });
        </script>


        <script>
            const deleteClass = document.querySelectorAll('.class-delete');
        </script>
        <script>
            deleteClass.forEach(button => {
                button.addEventListener('click', function() {
                    const cardId = button.dataset.cardId;

                    Notiflix.Confirm.show('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?', 'Ya',
                        'Batal',
                        function() {
                            fetch(`/master/pos/delete/${cardId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Notiflix.Notify.success("Data pos berhasil dihapus!", {
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
        </script>

        <script>
            const updateForms = document.querySelectorAll('.update-form');
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

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
                                Notiflix.Notify.success("Data kelas berhasil diperbarui!", {
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
        </script>

        <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
    @endpush
@endsection
