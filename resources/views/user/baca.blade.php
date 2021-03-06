@extends('/master/master')

@section('count', $count)

@section('display')
@foreach($disposisi as $D)
<?php if ($D->status==2||$D->status==3): ?>
  <li style="list-style: none;">
      <a href="{{url('/disposisi/show/'.$D->id)}}">
          <div class="icon-circle bg-blue-grey">
              <i class="material-icons">comment</i>
          </div>
          <div class="menu-info">
              <h4>Surat Baru Dari {{$D->surat_dari}}</h4>
              <p>
                  <i class="material-icons">access_time</i> Diperbaharui {{$D->updated_at}}
              </p>
          </div>
      </a>
  </li>
<?php endif; ?>
@endforeach
<?php if ($count==0): ?>
  <li style="list-style: none;">
          <div style="text-align: center;">
              <h5>Tidak Ada Notifikasi</h5>
          </div>
  </li>
<?php endif; ?>

@endsection

@section('menu')

<ul class="list">
    <li class="header">MAIN NAVIGATION</li>
    <a href="{{url('home')}}">
        <i class="material-icons">home</i>
        <span>Home</span>
    </a>
</li>
<li>
    <li class="active">
    <a href="{{url('surat_masuk')}}">
        <i class="material-icons">move_to_inbox</i>
        <span>Surat Masuk</span>
    </a>
</li>
<li>

  <a href="{{url('/surat_keluar')}}">
    <i class="material-icons">unarchive</i>
    <span>Surat Keluar</span>
</a>
</li>
<li>

  <a href="{{url('/surat_masuk/list')}}">
    <i class="material-icons">library_books</i>
    <span>Arsip</span>
</a>
</li>
</ul>
@endsection

@section('judul_halaman', 'USER')

@section('konten')

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
@foreach($disposisi as $D)
<form action="{{url('/surat_masuk/arsip')}}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <a href="{{url('/surat_masuk')}}">
            <button type="button" class="btn btn-primary waves-effect">
              <i class="material-icons">backspace</i>
              <span>KEMBALI</span>
            </button>
          </a>
        </div>
        <div class="body">
          <form id="form_advanced_validation" method="POST">
            <input type="hidden" name="id" value="{{ $D->id }}">
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="surat_dari" min="10" max="200" value="{{$D->surat_dari}}">
                <label class="form-label">Surat Dari</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="no_surat" min="10" max="200" value="{{$D->no_surat}}">
                <label class="form-label">No Surat</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="no_agenda" min="10" max="200" value="{{$D->no_agenda}}">
                <label class="form-label">No Agenda</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="date" class="form-control" name="tgl_surat" value="{{$D->tgl_surat}}">
                <label class="form-label">Tanggal Surat</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="date" class="form-control" name="tgl_terima" value="{{$D->tgl_terima}}">
                <label class="form-label">Tanggal Terima</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="perihal" value="{{$D->perihal}}">
                <label class="form-label">Perihal</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="kepada" value="{{$D->kepada}}">
                <label class="form-label">Kepada</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="isi_disposisi" value="{{$D->isi_disposisi}}">
                <label class="form-label">Isi Disposisi</label>
              </div>
            </div>
            <div class="form-group form-float">
              <div class="form-line">
                <input type="text" class="form-control" name="diteruskan_kpd" value="{{$D->diteruskan_kpd}}">
                <label class="form-label">Diteruskan Kepada</label>
              </div>
            </div>
            <input type="textarea" class="form-control" name="milik" value="{{(auth()->user()->role->role)}}" style="display:none;">
            <input type="textarea" class="form-control" name="surat_dari" value="{{(auth()->user()->role->role)}}" style="display:none;">
            <?php if ($D->status==3): ?>
              <button class="btn btn-primary waves-effect" type="submit" value="Upload">Arsipkan</button>
            <?php endif; ?>
            <?php if ($D->status==4): ?>
            <?php endif; ?>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
