var wizardDisposisi = function () {
  var _wizardEl;
  var _wizard;

  var initWizard = function initWizard() {
	_wizard = new KTWizard(_wizardEl, {
	  startStep: 1,
	  clickableSteps: true
	});


	_wizard.on('change', function (wizard) {
	  KTUtil.scrollTop();
	});
  };

  return {
	init: function init() {
	  _wizardEl = KTUtil.getById('wizard-disposisi');
	  initWizard();
	}
  };
}();

jQuery(document).ready(function () {
	wizardDisposisi.init();
	initKepada('#kepada');
	initTinyMCE('#uraian');
	initTandaTangan('#ttd');
});