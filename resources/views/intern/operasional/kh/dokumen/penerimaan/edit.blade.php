@extends('intern.layouts.app')

@section('title', 'Ubah Data Penerimaan Dokumen')

@section('barside')

  @include('intern.inc.barside_operasional')

@endsection

@section('page-breadcrumb')

<h4 class="page-title">Penerimaan Dokumen Karantina Hewan</h4>
<div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('show.operasional') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('showmenu.operasional.kh') }}">Menu</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kh.homeupload') }}">Upload</a></li>
            <li class="breadcrumb-item" aria-current="page">Penerimaan Dokumen</li>
        </ol>
    </nav>
</div>

@endsection

@section('content')

<style type="text/css">
  div.form-group{
    text-align: left !important;
  }
</style>

<div class="row">
  <div class="col-md-6 offset-md-2 col-sm-12">

    @include('intern.inc.message')

    <div class="card text-center">
      <div class="card-body">
        <h4>Ubah Data Penerimaan Dokumen Karantina Hewan</h4>
        <form action="{{ route('kh.dokumen.penerimaan.update', $penerimaan->id) }}" method="post" class="form-loader">

            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="form-group">
              <label for="wilker_id">Nama Wilker</label>
              <select name="wilker_id" class="form-control">
               
                @if(count($wilkers) > 0)

                    @foreach($wilkers as $w)

                      @if($w->id == $penerimaan->wilker_id)

<<<<<<< HEAD
                      <option value="{{ $w->id }}" selected>{{ $w->getOriginal('nama_wilker') }}</option>

                      @else

                      <option value="{{ $w->id }}">{{ $w->getOriginal('nama_wilker') }}</option>
=======
                      <option value="{{ $w->id }}" selected>{{ $w->nama_wilker }}</option>

                      @else

                      <option value="{{ $w->id }}">{{ $w->nama_wilker }}</option>
>>>>>>> 67c29aeccc0c7a28f91b3071026904c840692a41

                      @endif

                    @endforeach
                  
                @endif
                
              </select>
            </div>

            <div class="form-group">
              <label for="tanggal">Tanggal Penerimaan</label>
              <input type="date" name="tanggal" class="form-control" value="{{ $penerimaan->tanggal }}" required>
            </div>

            <div class="form-group">
              <label for="dokumen_id">Nama Dokumen</label>
              <select name="dokumen_id" class="form-control">
                @foreach($dokumens as $dokumen)

                  @if($dokumen->id == $penerimaan->dokumen_id)

                  <option value="{{ $dokumen->id }}" selected>{{ $dokumen->dokumen }}</option>

                  @else

                  <option value="{{ $dokumen->id }}">{{ $dokumen->dokumen }}</option>

                  @endif
                  
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="jumlah">Jumlah <i>(dalam satuan set)</i></label>
              <input type="number" min="0" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" oninput="this.value = Math.abs(this.value)" name="jumlah" class="form-control" required value="{{ $penerimaan->jumlah }}">
            </div>


            <div class="form-group">
              <label for="no_seri">No Seri</i></label>
              <br>
              <div class="float-left" style="width: 95%;">
                <input type="text" name="no_seri[]" class="form-control" placeholder="pisahkan dengan tanda (-) apabila no seri dokumen berjumlah lebih dari 1" value="{{ $penerimaan->no_seri }}">
              </div>
              <div class="float-right">
                  <button type="button" id="addNoseriButton"><i class="fa fa-plus"></i></button>
              </div>
               
              <div id="addNoseri" class="mt-3"></div>
            </div>
            <br>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
      </div>
    </div>
    <div class="col">
      <div class="text-center">
        <a href="{{ route('kh.dokumen.index') }}" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Kembali</a>
      </div>
    </div>
  </div>  

  @include('intern.operasional.rules.rule_dokumen')

</div>

@endsection

@section('script')
  
<script>
  $('#addNoseriButton').click(function(){

    $('#addNoseri').append(`

      <div class="float-left mt-2" style="width: 95%;">
        <input type="text" name="no_seri[]" class="form-control" required placeholder="nomor seri dokumen">
      </div>
      <div class="float-right mt-2">
          <button type="button" class="removeNoseriButton"><i class="fa fa-minus"></i></button>
      </div

    `);

    $('.removeNoseriButton').click(function(){

      $('#addNoseri').find('div.float-left').first().remove();
      $('#addNoseri').find('div.float-right').first().remove();

    });

  });
</script>

@endsection
