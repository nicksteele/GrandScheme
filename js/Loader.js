function Modal(elt) {
    var self = this;
    self.$elt = elt;

    self.Init = function () {
        self.$elt.click(self.LoadForm);
    };

    self.LoadForm = function (e) {
        var html = '<div class="ui-modal-bg js-modal"></div><div class="ui-modal js-modal"><div class="ui-close-modal js-close-modal">X</div>';
        html += $('#subscribe-form').html() + '</div>';
        self.$elt.append($(html)).find('.js-close-modal').click(self.CloseModal);
    };

    self.CloseModal = function (loc) {
        self.$elt.find('.js-modal').remove();
    };

    self.Populate = function (data) {
        self.$elt.find('.js-window').html(data);
        self.$elt.trigger('new-content');
    };
}

$.fn.Modal = function () {
    $(this).each(function (i, ele) {
        var $elt = $(ele);
        if ($elt.data('object')) return;
        $elt.data('object', new Modal($elt));
        $elt.data('object').Init();
    });
};