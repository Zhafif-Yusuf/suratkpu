<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('dashboard') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- Add your SVG logo here -->
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2"
                            style="display: flex; align-items: center; justify-content: center; margin-left: 20px; margin-right: 10px;">
                            <img src="{{ asset('assets/img/icons/brands/KPU_Logo.svg.png') }}" alt="Logo"
                                style="width: 50px; height: 50px; margin-right: 10px; margin-left: -35px;">
                            <span style="text-transform: capitalize;">Arsip Surat</span>

                    </a>
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Pages</span>
                    </li>
                    <li class="menu-item active">
                        <a href="{{ route('suratmasuk.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-mail-send"></i>
                            <div data-i18n="Surat Masuk">Surat Masuk</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('suratkeluar.index') }}" class="menu-link">
                            <!-- Ikon Surat Keluar -->
                            <i class="menu-icon tf-icons bx bx-send"></i>
                            <div data-i18n="Authentications">Surat Keluar</div>
                        </a>
                    </li>
                    <!-- User interface -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div data-i18n="User interface">Laporan</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('laporan.index') }}" class="menu-link">
                                    <div data-i18n="Accordion">Laporan Surat Masuk</div>
                                </a>
                            </li>
                            <li class="menu-item">
                            <li class="menu-item">
                                <a href="{{ route('laporan.suratkeluar') }}" class="menu-link">
                                    <div data-i18n="Laporan Surat Keluar">Laporan Surat Keluar</div>
                                </a>
                            </li>
                    </li>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-login-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Login</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-register-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Register</div>
                            </a>
                        </li>
                    </ul>
                    </li>
            </aside>
            <!-- /Menu -->

            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0);">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="User Avatar"
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                            alt="User Avatar" class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="bx bx-user me-2"></i><span
                                                class="align-middle">My Profile</span></a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bx bx-cog me-2"></i><span
                                                class="align-middle">Settings</span></a></li>
                                                <li>
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="dropdown-item">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
        </button>
    </form>
</li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- /Navbar -->

                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Edit Surat Masuk</h5>
                                <small class="text-muted float-end">Form untuk mengedit surat masuk</small>
                            </div>
                            <div class="card-body">
                                <form id="formSuratMasuk" action="{{ route('suratmasuk.update', $surat->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Nomor Surat -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="nomor_surat">Nomor Surat</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span id="nomor_surat2" class="input-group-text"><i
                                                        class="bx bx-mail-send"></i></span>
                                                <input type="text" name="nomor_surat" id="nomor_surat"
                                                    class="form-control"
                                                    value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Surat -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="tanggal_surat">Tanggal Surat</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                <input type="date" name="tanggal_surat" id="tanggal_surat"
                                                    class="form-control"
                                                    value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required
                                                    min="1900-01-01" max="2099-12-31" pattern="\d{4}-\d{2}-\d{2}"
                                                    title="Tanggal harus dalam format yyyy-mm-dd">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tujuan Surat -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="tujuan_surat">Asal Surat</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span id="tujuan_surat2" class="input-group-text"><i
                                                        class="bx bx-location-plus"></i></span>
                                                <input type="text" name="tujuan_surat" id="tujuan_surat"
                                                    class="form-control"
                                                    value="{{ old('tujuan_surat', $surat->tujuan_surat) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Perihal Surat -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="perihal_surat">Perihal Surat</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span id="perihal_surat2" class="input-group-text"><i
                                                        class="bx bx-clipboard"></i></span>
                                                <input type="text" name="perihal_surat" id="perihal_surat"
                                                    class="form-control"
                                                    value="{{ old('perihal_surat', $surat->perihal_surat) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- File Surat -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="file">File Surat</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <span id="file2" class="input-group-text"><i
                                                        class="bx bx-file"></i></span>
                                                <input type="file" name="file" id="file" class="form-control">
                                            </div>
                                            @if($surat->nama_file)
                                                <small>File yang sudah diupload: <a
                                                        href="{{ asset('storage/' . $surat->file) }}"
                                                        target="_blank">{{ $surat->nama_file }}</a></small>
                                            @else
                                                <small>Belum ada file yang diupload.</small>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="button" class="btn btn-primary" id="btnSubmit">Update</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- SweetAlert Script -->
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    document.getElementById('btnSubmit').addEventListener('click', function (e) {
                                        e.preventDefault(); // Prevent the form submission temporarily

                                        // Check if all required fields are filled
                                        const requiredFields = document.querySelectorAll('#formSuratMasuk input[required]');
                                        let allFilled = true;
                                        requiredFields.forEach(function (field) {
                                            if (!field.value.trim()) {
                                                allFilled = false;
                                            }
                                        });

                                        if (allFilled) {
                                            // Show SweetAlert notification for successful update
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: 'Data berhasil diperbarui.',
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then(function () {
                                                // Submit the form data after SweetAlert OK button is pressed
                                                document.getElementById('formSuratMasuk').submit();
                                            });
                                        } else {
                                            // Show SweetAlert error notification if any field is empty
                                            Swal.fire({
                                                title: 'Gagal!',
                                                text: 'Mohon lengkapi semua field yang diperlukan.',
                                                icon: 'error',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    });
                                </script>


                                <!-- / Content -->
                                <div class="content-backdrop fade"></div>
                            </div>
                            <!-- Content wrapper -->
                        </div>
                        <!-- / Layout page -->
                    </div>
                    <!-- Overlay -->
                    <div class="layout-overlay layout-menu-toggle"></div>
                </div>
                <!-- / Layout wrapper -->
                <!-- Core JS -->
                <script src="../assets/vendor/libs/jquery/jquery.js"></script>
                <script src="../assets/vendor/libs/popper/popper.js"></script>
                ⬤
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-3e8G2t9Ck9L1n8C6v3Z3wD3b3z3A3f3a3f3b3D3b3D3b3D3b3D3b3D3b3D3b3"
                    crossorigin="anonymous"></script>
                <script src="{{ asset('assets/js/main.js') }}"></script>