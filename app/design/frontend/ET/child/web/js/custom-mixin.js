define([
    'jquery'
], function ($) {
    'use strict';

    return function (widget) {
        $.widget('ves.megamenu', widget, {
            // Extend _initializeDrillDown
            _initializeDrillDown: function () {
                // Call original method first
                this._super();

                // Custom logic to ensure caret is added for items with submenu
                var htmlDrillOpener = '<span class="caret"></span>';
                $(".ves-megamenu .nav-item").each(function() {
                    var $anchor = $(this).children(".nav-anchor");
                    var $submenu = $(this).children(".submenu");

                    if ($submenu.length > 0) {
                        // Only add the drill-opener if it doesn't exist yet
                        if ($anchor.children(".opener").length) {
                            $anchor.children(".opener").prepend($(htmlDrillOpener)); // <-- prepend instead of append
                        }
                    }
                });
            }

        });

        return $.ves.megamenu;
    };
});
