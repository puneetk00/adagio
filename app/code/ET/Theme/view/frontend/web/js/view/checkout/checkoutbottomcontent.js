define(
    [
        'jquery',
        'ko',
        'uiComponent'
    ],
    function(
        $,
        ko,
        Component
    ) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'ET_Theme/checkout/checkoutbottomcontent'
            },

            initialize: function () {
                var self = this;
                this._super();
            }

        });
    }
);