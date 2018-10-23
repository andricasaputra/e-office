@extends('layouts.app')

@section('content')

<main class="content-wrapper">
  <div class="mdc-layout-grid">
    <div class="mdc-layout-grid__inner">
      <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
          <div class="mdc-card">
            <div class="mdc-layout-grid__inner">
              <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-7">
                <section class="purchase__card_section">
                    
                    @include('inc.message')

                    <h4>Upload Impor Karantina Tumbuhan</h4>
                    <div class="col-md-12">
                      <div class="row">
                        <form action="{{ route('kt.upload.proses.impor') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="form-group">
                              <label for="wilker_id">Nama Wilker</label>
                              <select name="wilker_id" class="form-control">
                                <option value="{{ $wilker->id }}">{{ $wilker->nama_wilker }}</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="filenya">Pilih File Laporan</label>
                              <input type="file" name="filenya" class="form-control">
                            </div>
                            <input type="submit" name="Import" class="btn btn-success" value="Upload">
                        </form>
                      </div>
                    </div>
                </section>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</main>

@endsection
