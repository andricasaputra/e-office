@extends('intern.layouts.admin')

@section('title', 'Home')

@section('barside.title', 'IKM Sumbawa')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="page-title">
	  <div class="title_left">
	    <h3>Hasil Survey IKM</h3>
	  </div>
	</div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_content">
	    <table id="adminHomeIkm" class="table table-striped table-bordered text-center" width="100%">
	      <thead>
	        <tr>
	          <th>No</th>
	          <th>Responden ID</th>
	          <th>Layanan</th>
	          <th>Jenis Kelamin</th>
	          <th>Umur</th>
	          <th>Pendidikan</th>
	          <th>Pekerjaan</th>
	          <th>Action</th>
	        </tr>
	      </thead>
	    </table>
	  </div>
	</div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDeleteIkm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<h3>Apakah Anda Yakin Ingin Meghapus Data Ini?</h3><br>
        <form action="{{route('intern.ikm.destroy', 'delete')}}" method="post">

	  		@csrf
        	@method('DELETE')

        	<input type="hidden" name="id" id="ikmId">
        	
        	<input type="submit" name="delete" value="Ya" class="btn btn-primary">

        	<button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
	  	</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

  <script>
    $(document).ready(function() {

    	let url = '{{ route('api.ikm') }}';
    	let data = [

	    	{ "data" : "DT_Row_Index", orderable: false, searchable: false},
	        { "data" : "id" },
	        { "data" : "layanan.jenis_layanan" },
	        { "data" : "jenis_kelamin" },
	        { "data" : "umur.umur" },
	        { "data" : "pekerjaan.pekerjaan" },
	        { "data" : "pendidikan.pendidikan" },
	        { "data" : "action" , orderable: false, searchable: false}

		]

	    $('#adminHomeIkm').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax":{
               "url": url,
               "dataType": "JSON"
            },
            "columns": data,
			"columnDefs": [{
			    "defaultContent": "-",
			    "targets": "_all"
			}]

        });

  	});

  	$(document).on('click', '#deleteIkm', function(e){

        e.preventDefault();
        let id = $( this ).data( 'id' );

        $('#modalDeleteIkm').modal('show');

        let idInForm = $("#modalDeleteIkm #ikmId").val(id);

    });
  </script>

@endsection