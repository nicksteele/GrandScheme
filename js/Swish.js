function Swish(elt) {
    var self = this;
    self.$elt = elt;

    self.Init = function () {
		//these will swap
        self.$elt.find('.js-swish-show').click(self.ShowSwish);
		self.$elt.find('.js-swish-hide').click(self.HideSwish);
		//this class will always close
		self.$elt.find('.js-swish-close').click(self.HideSwish);
    };

    self.ShowSwish = function (e) {//the number of pix +/- relative pos
	   self.$elt.find('.js-swish-show').removeClass('js-swish-show').addClass('js-swish-hide');
       self.$elt.animate({ right: "+=425px",}, 2000 );//2 secs --> slow
    };

    self.HideSwish = function (e) {
		self.$elt.find('.js-swish-hide').removeClass('js-swish-hide').addClass('js-swish-show');
        self.$elt.animate({ right: "-=420px",}, 2000 );
    };
}

$.fn.Swish = function () {
    $(this).each(function (i, ele) {
        var $elt = $(ele);
        if ($elt.data('object')) return;
        $elt.data('object', new Swish($elt));
        $elt.data('object').Init();
    });
};