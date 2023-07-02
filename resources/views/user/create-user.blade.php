@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar User</div>

                <div class="card-body">
                    <form method="POST"  action="{{ url('store-user') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="nip" aria-describedby="nip" required>

                    </div>
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" required>

                        </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="school">Sekolah</label>
                            <select class="form-control" id="school_id" name="school_id">
                               @foreach ($school as $data)
                                  <option value="{{ $data->id }}">{{ $data->name }}</option>
                               @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role_id" name="role_id">
                               @foreach ($role as $data)
                                  <option value="{{ $data->id }}">{{ $data->name }}</option>
                               @endforeach
                            </select>
                         </div>
                        <div class="form-group mt-2">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-danger mt-3"><a href="{{ URL::previous() }}">Go Back</a></button>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<script type="text/javascript" class="init">


$(document).ready(function () {
	var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
});

</script>

@endsection



