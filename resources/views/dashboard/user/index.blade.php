<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
        </style>
    @endpush
    @push('js')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    language: {
                        emptyTable: "Data tidak ada"
                    }
                });

                // DELETE BUTTON
                // Ketika tombol "Hapus" di modal diklik
                let deleteUrl = '';
                let deleteId = '';

                // Ketika tombol delete diklik, ambil URL dan ID
                $('.btn-delete').on('click', function () {
                    deleteUrl = $(this).data('url');
                    deleteId = $(this).data('id');
                });
                $('#confirmDelete').on('click', function () {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _method: 'DELETE', // Laravel membutuhkan method DELETE
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function (response) {
                            // Sukses, tutup modal dan hapus elemen terkait
                            $('#deleteModal').modal('hide');
                            $(`button[data-id="${deleteId}"]`).closest('.mx-2').remove();

                            // Tambahkan alert Bootstrap 5 di halaman
                            const alert = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Berhasil menghapus data.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                            $('#alerts-container').append(alert); // Append alert ke container
                        },
                        error: function (xhr) {
                            $('#deleteModal').modal('hide'); // Tutup modal
                            const alert = `
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Terjadi kesalahan saat menghapus data!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                            $('#alerts-container').append(alert); // Append alert ke container

                        }
                    });
                });
            })
        </script>
    @endpush
    @include('dashboard.user.modal')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</h2>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Tambah Data</a>
            </div>
        </div>
        @include('components.notification')
        <div id="alerts-container"></div>
        <div class="card mb-4">
            <header class="card-header">
                <h4>List User</h4>
            </header>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered border table-hover" id="example">
                        <thead>
                            <tr class="border">
                                <th>No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Hak Akses </th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->roles[0]->name ?? '-' }}</td>
                                    <td class="text-start">
                                        <div class="d-flex justify-content-start">
                                            <div>
                                                <a href="{{ route('user.edit',$item->id) }}" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                                            </div>
                                            @if (auth()->user()->id != $item->id)
                                                <div class="mx-2">
                                                    <button
                                                        class="btn btn-sm font-sm btn-light rounded btn-delete"
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('user.destroy', $item->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal">
                                                        <i class="material-icons md-delete_forever"></i> Delete
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
