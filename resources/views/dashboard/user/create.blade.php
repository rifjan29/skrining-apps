<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    @endpush
    @push('js')
        <script>
           $(document).ready(function(){
                $("#toggle").change(function(){

                    // Check the checkbox state
                    if($(this).is(':checked')){
                    // Changing type attribute
                        $("#password").attr("type","text");

                        // Change the Text
                        $("#toggleText").text("Hide");
                        }else{
                        // Changing type attribute
                        $("#password").attr("type","password");

                        // Change the Text
                        $("#toggleText").text("Show");
                    }

                });
            });

        </script>
    @endpush
    <section class="content-main mb-5">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }} User</h2>
            <div>
                <button onclick="history.back()" class="btn btn-light"><i class="text-muted material-icons md-arrow_back"></i>Kembali</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <header class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>Tambah Data User</h4>
                        </div>

                    </header>
                    <div class="card-body">
                            <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Nama </label>
                                        <input placeholder="Masukkan Data" type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" />
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{$message}}.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Email </label>
                                        <input placeholder="Masukkan Data" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Password </label>
                                        <div class="d-flex flex-row">
                                            <div class="w-75">
                                                <input placeholder="Masukkan Data" style="height: 41px" type="password" id="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password" />
                                            </div>
                                            <div class="align-self-center mx-2">
                                                <label for="">
                                                    <input type='checkbox' id='toggle' value='0'>
                                                    <span id='toggleText' class="align-center-self">Show</span>
                                                </label>
                                            </div>

                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Hak Akses </label>
                                        <select name="role" class="form-select" id="">
                                            <option value="admin">Admin</option>
                                            <option value="petugas">Petugas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="d-flex justify-content-end mb-5">
            <button type="reset" class="btn btn-outline-danger">Batal</button>
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>
            </form>

        </div>
        <!-- card end// -->
    </section>
</x-app-layout>
