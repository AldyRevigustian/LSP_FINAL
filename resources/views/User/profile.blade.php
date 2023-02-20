@extends('layouts.app')

@include('components.user')

@section('content')
    <style>
        input:read-only {
            background-color: white;
            pointer-events: all
        }

        ;
    </style>
    <div class="page-heading">
        @include('message')
        <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card shadow-sm">

                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center mb-1">
                            <h3>Profile Saya</h3>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ Auth::user()->foto == null ? '/assets/images/faces/1.jpg' : Auth::user()->foto }}"
                            alt="" class="rounded-circle"
                            style="width: 200px;height: 200px;object-fit: cover; margin-bottom: 30px; margin-top: 20px">
                    </div>
                    <table class="table">
                        <tr>
                            <th>Foto Profile</th>
                            <td>
                                <input type="file" accept="image/*" name="foto" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>
                                <input class="form-control" type="text" name="fullname"
                                    value="{{ Auth::user()->fullname }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>
                                <input class="form-control" type="text" name="username"
                                    value="{{ Auth::user()->username }}">
                            </td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td>
                                <input class="form-control" type="number" name="nis" value="{{ Auth::user()->nis }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>
                                <textarea name="alamat" class="form-control">{{ Auth::user()->alamat }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>Kelas</th>
                            <td>
                                <input class="form-control" type="text" name="kelas" value="{{ Auth::user()->kelas }}">
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function toggle(checkboxID, toggleID) {
            var checkbox = document.getElementById(checkboxID);
            var toggle = document.getElementById(toggleID);
            updateToggle = checkbox.checked ? toggle.disabled = true : toggle.disabled = false;
        }
    </script>
@endsection
