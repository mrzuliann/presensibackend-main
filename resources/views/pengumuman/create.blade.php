@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Pengumuman</div>
                
                <div class="card-body">
                    <form method="POST"  action="{{ url('store-pengumuman') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nip">Judul</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="nip" aria-describedby="nip">
                        
                    </div>
                    <div class="form-group">
                        <div class="form-group mt-2">
                            <label for="exampleInputEmail1">Deskripsi</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
                        </div>
                       
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



