@extends('layouts.nice')

@section('contect')
<div class="container">
        <h3 class="my-4">Master Users</h3>
        <a href="" class="btn btn-primary my-2">Tambah Users</a>
        <!--begin::Row-->
        <div class="row">
            <div class="card mb-4">
                <!-- /.card-header -->
                <div class="card-body p-0">
                   <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama Users</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->password }}</td>
                                <td>
                                    <a href="" class="btn btn-primary my-2">Edit</a>
                                    <a href="" class="btn btn-danger my-2">Hapus</a>
                                </td>
                            </tr> 
                            @endforeach --}}
                        </tbody>
                    </table>  
                </div>
            </div>
        </div> 
@endsection