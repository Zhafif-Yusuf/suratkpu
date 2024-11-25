@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Surat Masuk</h5>
            <small class="text-muted float-end">Form untuk mengedit surat masuk</small>
        </div>
        <div class="card-body">
            <form action="{{ route('surat_masuk.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nomor Surat -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nomor_surat">Nomor Surat</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span id="nomor_surat2" class="input-group-text"><i class="bx bx-mail-send"></i></span>
                            <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Tanggal Surat -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal_surat">Tanggal Surat</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Tujuan Surat -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tujuan_surat">Tujuan Surat</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span id="tujuan_surat2" class="input-group-text"><i class="bx bx-location-plus"></i></span>
                            <input type="text" name="tujuan_surat" id="tujuan_surat" class="form-control" value="{{ old('tujuan_surat', $surat->tujuan_surat) }}" required>
                        </div>
                    </div>
                </div>

                <!-- Perihal Surat -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="perihal_surat">Perihal Surat</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span id="perihal_surat2" class="input-group-text"><i class="bx bx-clipboard"></i></span>
                            <input type="text" name="perihal_surat" id="perihal_surat" class="form-control" value="{{ old('perihal_surat', $surat->perihal_surat) }}" required>
                        </div>
                    </div>
                </div>

                <!-- File Surat -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="file">File Surat</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <span id="file2" class="input-group-text"><i class="bx bx-file"></i></span>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        @if($surat->nama_file)
                            <small>File yang sudah diupload: <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">{{ $surat->nama_file }}</a></small>
                        @else
                            <small>Belum ada file yang diupload.</small>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
