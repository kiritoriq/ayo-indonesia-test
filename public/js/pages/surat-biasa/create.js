var initWizard = function () {
var _wizardEl;
var _formEl;
var _wizard;
var _validations = [];

var onWizard = function onWizard() {
  _wizard = new KTWizard(_wizardEl, {
    startStep: 1,
    clickableSteps: true
  });

  _wizard.on('beforeNext', function (wizard) {
    _validations[wizard.getStep() - 1].validate().then(function (status) {
      //if (status == 'Valid') {
        _wizard.goNext();

        KTUtil.scrollTop();
      /** } else {
        Swal.fire({
          text: "Sorry, looks like there are some errors detected, please try again.",
          icon: "error",
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light"
          }
        }).then(function () {
          KTUtil.scrollTop();
        });
      } **/
    });

    _wizard.stop(); // Don't go to the next step

  }); // Change event


  _wizard.on('change', function (wizard) {
    KTUtil.scrollTop();
  });
};

var initValidation = function initValidation() {
  // Step 1
  _validations.push(FormValidation.formValidation(_formEl, {
    fields: {
      klasifikasi: {
        validators: {
          notEmpty: {
            message: 'Klasifikasi harus dipilih'
          }
        }
      },
      sifat: {
        validators: {
          notEmpty: {
            message: 'Sifat tidak boleh kosong'
          }
        }
      },
      keamanan: {
        validators: {
          notEmpty: {
            message: 'Keamanan tidak boleh kosong'
          }
        }
      },
      tanggal: {
        validators: {
          notEmpty: {
            message: 'Tanggal tidak boleh kosong'
          }
        }
      },
      perihal: {
        validators: {
          notEmpty: {
            message: 'Perihal tidak boleh kosong'
          }
        }
      },
      kepada: {
        validators: {
          notEmpty: {
            message: 'Kepada tidak boleh kosong'
          }
        }
      },
      perhatian: {
        validators: {
          notEmpty: {
            message: 'Perhatian tidak boleh kosong'
          }
        }
      },
      lokasi: {
        validators: {
          notEmpty: {
            message: 'Lokasi tidak boleh kosong'
          }
        }
      },
      tembusan: {
        validators: {
          notEmpty: {
            message: 'Tembusan tidak boleh kosong'
          }
        }
      },
      uraian: {
        validators: {
          callback: {
              message: 'The comment must be between 5 and 200 characters long',
              callback: function(value) {
                  const text = tinyMCE.activeEditor.getContent({
                      format: 'text'
                  });
                  return text.length <= 200 && text.length >= 5;
              }
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap()
    }
  })); // Step 2


  _validations.push(FormValidation.formValidation(_formEl, {
    fields: {
      "package": {
        validators: {
          notEmpty: {
            message: 'Package details is required'
          }
        }
      },
      weight: {
        validators: {
          notEmpty: {
            message: 'Package weight is required'
          },
          digits: {
            message: 'The value added is not valid'
          }
        }
      },
      width: {
        validators: {
          notEmpty: {
            message: 'Package width is required'
          },
          digits: {
            message: 'The value added is not valid'
          }
        }
      },
      height: {
        validators: {
          notEmpty: {
            message: 'Package height is required'
          },
          digits: {
            message: 'The value added is not valid'
          }
        }
      },
      packagelength: {
        validators: {
          notEmpty: {
            message: 'Package length is required'
          },
          digits: {
            message: 'The value added is not valid'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap()
    }
  })); // Step 3


  _validations.push(FormValidation.formValidation(_formEl, {
    fields: {
      delivery: {
        validators: {
          notEmpty: {
            message: 'Delivery type is required'
          }
        }
      },
      packaging: {
        validators: {
          notEmpty: {
            message: 'Packaging type is required'
          }
        }
      },
      preferreddelivery: {
        validators: {
          notEmpty: {
            message: 'Preferred delivery window is required'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap()
    }
  })); // Step 4


  _validations.push(FormValidation.formValidation(_formEl, {
    fields: {
      locaddress1: {
        validators: {
          notEmpty: {
            message: 'Address is required'
          }
        }
      },
      locpostcode: {
        validators: {
          notEmpty: {
            message: 'Postcode is required'
          }
        }
      },
      loccity: {
        validators: {
          notEmpty: {
            message: 'City is required'
          }
        }
      },
      locstate: {
        validators: {
          notEmpty: {
            message: 'State is required'
          }
        }
      },
      loccountry: {
        validators: {
          notEmpty: {
            message: 'Country is required'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap: new FormValidation.plugins.Bootstrap()
    }
  }));
};

return {
  init: function init() {
    _wizardEl = KTUtil.getById('kt_wizard_v3');
    _formEl = KTUtil.getById('kt_form');
    onWizard();
    initValidation();
  }
};
}();

function tipe_ttd(ID){
	$('#from option').remove();
	$('#from_an option').remove();
	$('#from_ub option').remove();
	switch(ID) {
	case 'tdt':
		$('#tdt').show();
		$('#tdt_an').hide();
		$('#tdt_ub').hide();
		$('#tdt_plt').hide();
		$('#tdt_plh').hide();
		$('#from').append('<option value="" selected="selected"></option>');
		$('#from_an').append('<option value="" selected="selected"></option>');
		$('#from_ub').append('<option value="" selected="selected"></option>');
	break;
	case 'an':
		$('#tdt').show();
		$('#tdt_an').show();
		$('#tdt_ub').hide();
		$('#tdt_plt').hide();
		$('#tdt_plh').hide();
		$('#from').append('<option value="" selected="selected"></option>');
		$('#from_an').append('<option value="" selected="selected"></option>');
		$('#from_ub').append('<option value="" selected="selected"></option>');
	break;
	case 'plt':
		$('#tdt').show();
		$('#tdt_an').hide();
		$('#tdt_ub').hide();
		$('#tdt_plt').show();
		$('#tdt_plh').hide();
		$('#from').append('<option value="" selected="selected"></option>');
		$('#from_plt').append('<option value="" selected="selected"></option>');
		$('#from_ub').append('<option value="" selected="selected"></option>');
	break;
	case 'plh':
		$('#tdt').show();
		$('#tdt_an').hide();
		$('#tdt_ub').hide();
		$('#tdt_plt').hide();
		$('#tdt_plh').show();
		$('#from').append('<option value="" selected="selected"></option>');
		$('#from_plh').append('<option value="" selected="selected"></option>');
		$('#from_ub').append('<option value="" selected="selected"></option>');
	break;
	case 'ub':
		$('#tdt').show();
		$('#tdt_an').show();
		$('#tdt_ub').show();
		$('#tdt_plt').hide();
		$('#tdt_plh').hide();
		$('#from').append('<option value="" selected="selected"></option>');
		$('#from_an').append('<option value="" selected="selected"></option>');
		$('#from_ub').append('<option value="" selected="selected"></option>');
	break;
	}
}

function delete_app(id){
	$('#tabel_persetujuan tr#a'+id).remove();
}

function delete_row(id) {
	$('#lampiran_'+id).remove();
}

jQuery(document).ready(function () {
	initWizard.init();
	initTinyMCE("#uraian")
	initKlasifikasi('#klasifikasi');
	initSifatSurat('#sifat');
    initTipeTTD('#tipe_ttd');
	initKeamananSurat('#keamanan');
	initKepada('#kepada');
	initKepada('#kepada_penerima');
	initKepada('#untuk_perhatian');
	initTandaTangan('.ttd');
	initTembusan('#tembusan');
	initSelect2Tag('#penerima_teks');
	initUploadLampiran('lampiran_surat_biasa', '#add_lampiran_file');
	initSebutanPengganti(".sebutan-pengganti");
  
	let i = 0;
	$("#add_lampiran_teks").click(function(){
		i++;
		let form_lampiran_text = '<div class="form-group" id="lampiran_'+i+'"><div class="col-lg-12"><label><a href="#" onclick="delete_row('+i+')" class="btn btn-sm btn-danger btn-hover-light-danger font-weight-bold"><i class="flaticon-delete"></i> Hapus Lampiran</a></label><textarea class="form-control textarea" name="lampiran[]" placeholder="Lampiran" rows="5"></textarea><div class="fv-plugins-message-container"></div></div></div>';
		$("#init_lampiran").append(form_lampiran_text);
		
		initTinyMCE('.textarea')
	});
	
	tipe_ttd($("#tipe_ttd :selected").val());
	$("#tipe_ttd").on("change", function(){
		let id = $(this).val();
		tipe_ttd(id);
	});
	
	let a = 3;
	$("#add_persetujuan").click(function(e){
		e.preventDefault();
		let form ='<tr id="a'+a+'">';
		form += '<td class="text-center"><a class="btn btn-sm btn-icon btn-danger delete_app" onclick="delete_app(`'+a+'`)" key="'+a+'"><i class="flaticon-delete"></i></a></td>';
		form += '<td><select class="form-control pejabat" id="process_user_'+a+'" name="process_user[]" style="width:100%"></select></td>';
		form += '<td><select class="form-control proses-tipe" id="process_type_'+a+'" name="process_type[]" style="width:100%"></select></td>';
		form += '</tr>';
		$("#tabel_persetujuan tbody").append(form);
		a++;
		
		initKepada('.pejabat');
		initProsesTipe('.proses-tipe');
		
		$(".delete_app").on('click',function(){
			var key = $(this).attr("key");
			if(key)
			{
				delete_app(key);
			}
		});
	});
});