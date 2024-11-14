<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard</title>
    <meta name="description" content="" />
    <link rel="icon" href="{{ asset('assets/img/logo-bartech-no-text.png') }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }} " class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Datatables CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/dt-2.1.5/b-3.1.2/b-html5-3.1.2/r-3.0.3/sc-2.4.3/sb-1.8.0/datatables.min.css"
        rel="stylesheet">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    {{-- aos --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .swal2-container {
            z-index: 9999 !important;
        }

        .select2-container {
            width: 250px !important;
        }

        .select2-container .select2-selection {
            height: 38px !important;
            line-height: 36px !important;
            padding-top: 0 !important;
        }

        .select2-dropdown {
            width: auto !important;
            /* Adjust dropdown width automatically */
            min-width: 250px;
            /* Set a minimum width for consistency */
        }

        #defaultSelect+.select2-container {
            width: 556px !important;
            border: 0.1px solid #D9DEE3;
            border-radius: 4px;
        }

        .card-equal-height {
            height: 100%;
            /* Tinggi card kanan 100% mengikuti card kiri */
        }

        textarea {
            width: 100%;
            /* Mengatur lebar textarea menjadi 100% dari container */
            height: auto;
            /* Tinggi otomatis */
        }

        .tox {
            max-width: 100% !important;
            /* Mengatur maksimum lebar editor menjadi 100% */
        }

        /* Agar editor lebih responsif */
        .tox .tox-edit-area {
            min-height: 200px;
            /* Tinggi minimum editor, sesuaikan sesuai kebutuhan */
        }
    </style>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Event handler untuk tombol delete
            $('button[id^="deleteButton"]').on('click', function(e) {
                e.preventDefault();

                // Mengambil ID form dari tombol yang diklik
                var formId = $(this).closest('form').attr('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika user mengonfirmasi penghapusan
                        $('#' + formId).submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>

    {{-- Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('backend.sidebar')

            <div class="layout-page">

                @include('backend.navbar')

                <div class="content-wrapper">
                    @yield('content')
                </div>

                <br>
                @include('backend.footer') <br>
            </div>

        </div>
    </div>

    <!-- Datatables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/dt-2.1.5/b-3.1.2/b-html5-3.1.2/r-3.0.3/sc-2.4.3/sb-1.8.0/datatables.min.js">
    </script>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <!-- Tooltip JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    @include('sweetalert::alert')
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Toast SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Modal --}}
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @if (session('editId'))
                    // Jika ada error dan session editId, tampilkan modal edit yang sesuai
                    $('#Edit{{ session('editId') }}').modal('show');
                @else
                    // Jika tidak ada editId, tampilkan modal create
                    $('#modalCenter').modal('show');
                @endif
            @endif
        });

        // @if ($errors->any())
        //     $(document).ready(function() {
        //         $('#modalCenter').modal('show');
        //     });
        // @endif
    </script>

    {{-- Checkbox di role --}}
    <script>
        $(document).ready(function() {
            // Event listener untuk semua checkbox
            $('.permission-checkbox').on('change', function() {
                var group = $(this).data('group'); // Ambil kategori (misal 'role')
                var type = $(this).data('type'); // Ambil tipe (misal 'list', 'create', dll)

                // Jika yang di-check/uncheck adalah tipe 'list'
                if (type === 'list') {
                    var isChecked = $(this).is(':checked');

                    // Check/uncheck checkboxes yang memiliki group sama (misal 'role')
                    $('.permission-checkbox[data-group="' + group + '"]').each(function() {
                        if ($(this).data('type') !== 'list') { // Selain yang 'list'
                            $(this).prop('checked', isChecked);
                        }
                    });
                }
            });
        });
    </script>

    {{-- Select2 --}}
    <script>
        $(document).ready(function() {
            $('.form1').select2({
                placeholder: "Semua Pelatihan",
                allowClear: true
            });
            $('.form2').select2({
                placeholder: "Semua Pelatihan",
                allowClear: true,
                dropdownParent: $('#modalCenter'),
                width: '100%'
            });
        });
    </script>




    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
