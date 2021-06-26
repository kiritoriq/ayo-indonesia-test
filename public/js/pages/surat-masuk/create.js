$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

var LampiranUpload = function () {
    var Tus = Uppy.Tus;
    var StatusBar = Uppy.StatusBar;
    var FileInput = Uppy.FileInput;
    var Informer = Uppy.Informer;

    var initUppy5 = function initUppy5() {
        var elemId = 'kt_uppy_5';
        var id = '#' + elemId;
        var $statusBar = $(id + ' .uppy-status');
        var $uploadedList = $(id + ' .uppy-list');
        var timeout;
        var uppyMin = Uppy.Core({
            debug: true,
            autoProceed: true,
            showProgressDetails: true,
            restrictions: {
                maxFileSize: 1000000,
                maxNumberOfFiles: 5,
                minNumberOfFiles: 1
            }
        });
        uppyMin.use(FileInput, {
            target: id + ' .uppy-wrapper',
            pretty: false
        });
        uppyMin.use(Informer, {
            target: id + ' .uppy-informer'
        });

        uppyMin.use(Tus, {
            endpoint: 'https://master.tus.io/files/'
        });
        uppyMin.use(StatusBar, {
            target: id + ' .uppy-status',
            hideUploadButton: true,
            hideAfterFinish: false
        });
        $(id + ' .uppy-FileInput-input').addClass('uppy-input-control').attr('id', elemId + '_input_control');
        let $fileLabel = $('#upload-btn');
        uppyMin.on('upload', function (data) {
            $fileLabel.text("Uploading...");
            $statusBar.addClass('uppy-status-ongoing');
            $statusBar.removeClass('uppy-status-hidden');
            clearTimeout(timeout);
        });
        var no = 0;
        uppyMin.on('complete', function (file) {
            $.each(file.successful, function (index, value) {
                no += 1;
                console.log(no);
                var sizeLabel = "bytes";
                var filesize = value.size;
                var ext = value.extension;

                if (filesize > 1024) {
                    filesize = filesize / 1024;
                    sizeLabel = "kb";

                    if (filesize > 1024) {
                        filesize = filesize / 1024;
                        sizeLabel = "MB";
                    }
                }

                var uploadListHtml = '<div class="uppy-list-item" ' + (no === 1 ? "style='margin-top: -30px'" : "") + ' data-id="' + value.id + '"><input type="text" class="form-control" name="filename[]" value="' + value.name + '" /><span style="font-size: 2em !important" class="uppy-list-remove" data-id="' + value.id + '"><i class="la la-trash text-danger" style="font-size: 1em !important"></i></span></div>';
                $uploadedList.append(uploadListHtml);
            });
            $fileLabel.html(`<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo1/dist/../src/media/svg/icons/Files/Upload.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                                    <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                                </svg></span> Tambah File Lain`);
            $statusBar.addClass('uppy-status-hidden');
            $statusBar.removeClass('uppy-status-ongoing');
        });

        $(document).on('click', id + ' .uppy-list .uppy-list-remove', function () {
            var itemId = $(this).attr('data-id');
            uppyMin.removeFile(itemId);
            $(id + ' .uppy-list-item[data-id="' + itemId + '"').remove();
        });
    };
    return {
        init: function init() {
            initUppy5();
        }
    };
}();

var KTDatatablesBasicBasic = function () {
    var tableSuratMasuk = function tableSuratMasuk() {
        var table = $('.datatable-surat-masuk');

        table.DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            info: false,
            language: {
                'lengthMenu': 'Display _MENU_'
            },
            order: [
                [1, 'desc']
            ],
            columnDefs: []
        });
    };


    return {
        init: function init() {
            tableSuratMasuk();
        }
    };
}();

var suratMasukForm = function () {

    var _initWidgets = function () {
        initTinyMCE('#uraian');
        initKlasifikasi('#klasifikasi');
        initSifatSurat('#sifat');
        initKeamananSurat('#keamanan');
        initKepada('#kepada_opd');
        initTembusan('#tembusan');
        initNaskah('#jenis_naskah');

        $('#jenis_naskah').on('change', function () {
            validator.revalidateField('jenis_naskah');
        });
        $('#klasifikasi').on('change', function () {
            validator.revalidateField('klasifikasi');
        });
        $('#kepada_opd').on('change', function () {
            validator.revalidateField('kepada[]');
        });
        $('#keamanan').on('change', function () {
            validator.revalidateField('keamanan');
        });
        $('#sifat').on('change', function () {
            validator.revalidateField('sifat');
        });
        $('#tembusan').on('change', function () {
            validator.revalidateField('tembusan[]');
        });
    }

    var _validsuratmasuk = function () {
        validator = FormValidation.formValidation(
            document.getElementById('frm_surat_masuk'), {
                fields: {
                    klasifikasi: {
                        validators: {
                            notEmpty: {
                                message: 'Klasifikasi tidak boleh kosong'
                            },
                        }
                    },
                    no_surat: {
                        validators: {
                            notEmpty: {
                                message: 'No Surat tidak boleh kosong'
                            },
                        }
                    },
                    jenis_naskah: {
                        validators: {
                            notEmpty: {
                                message: 'Jenis naskah harus dipilih'
                            },
                        }
                    },
                    sifat: {
                        validators: {
                            notEmpty: {
                                message: 'Sifat harus dipilih'
                            },
                        }
                    },
                    keamanan: {
                        validators: {
                            notEmpty: {
                                message: 'Keamanan harus dipilih'
                            },
                        }
                    },
                    tgl: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal tidak boleh kosong'
                            },
                        }
                    },
                    perihal: {
                        validators: {
                            notEmpty: {
                                message: 'Perihal tidak boleh kosong'
                            },
                        }
                    },
                    'kepada[]': {
                        validators: {
                            notEmpty: {
                                message: 'Kepada tidak boleh kosong'
                            },
                        }
                    },
                    'tembusan[]': {
                        validators: {
                            notEmpty: {
                                message: 'Tembusan tidak boleh kosong'
                            },
                        }
                    },
                    pengirim: {
                        validators: {
                            notEmpty: {
                                message: 'Pengirim tidak boleh kosong'
                            },
                        }
                    },

                    uraian: {
                        validators: {
                            callback: {
                                message: 'Uraian harus lebih dari 20 huruf',
                                callback: function (value) {
                                    const text = tinyMCE.activeEditor.getContent({
                                        format: 'text'
                                    });

                                    return text.length <= 200 && text.length >= 20;
                                }
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        );
    }

    return {
        init: function () {
            _validsuratmasuk();
            _initWidgets();
        }
    };
}();

jQuery(document).ready(function () {
    KTDatatablesBasicBasic.init();
    suratMasukForm.init();
    LampiranUpload.init();
});
