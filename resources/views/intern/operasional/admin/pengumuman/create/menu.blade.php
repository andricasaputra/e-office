@extends('intern.layouts.app')

@section('title', 'Menu Pengumuman')

@section('barside')

  @include('intern.inc.barside_operasional')

@endsection

@section('page-breadcrumb')

<h4 class="page-title">Menu Pengumuman</h4>
<div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('show.operasional') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.home') }}"> Home Admin </a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a></li>
            <li class="breadcrumb-item" aria-current="page">Menu Pengumuman</li>
        </ol>
    </nav>
</div>

@endsection

@section('content')

<style type="text/css">

  i.fa-2x {
    display: inline-block;
    border-radius: 80px;
    box-shadow: 0px 0px 2px #888;
    padding: 0.5em 0.6em;
  }

  .fa-upload{
    background-color: #008000;
    color: #fff;
  }

  .fa-bell{
    background-color: #16C2D0;
    color: #fff
  }


</style>

<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="card text-center">
      <div class="card-header">
        Pengumuman update aplikasi
      </div>
      <div class="card-body">
        <i class="fa fa-upload fa-2x mb-4"></i>
        <h4 class="card-text">
          Update Aplikasi
        </h4>
      </div>
      <div class="card-footer bg-transparent">
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-default">Masuk</a>
      </div>
    </div>
  </div>  
  <div class="col-md-6 col-sm-12">
    <div class="card text-center">
      <div class="card-header">
        Custom notifikasi
      </div>
      <div class="card-body">
        <i class="fa fa-bell fa-2x mb-4"></i>
        <h4 class="card-text">
          Hanya Notifikasi
        </h4>
      </div>
      <div class="card-footer bg-transparent">
        <a href="{{ route('kt.homeupload') }}" class="btn btn-default">Masuk</a>
      </div>
    </div>
  </div>  
</div>

@endsection