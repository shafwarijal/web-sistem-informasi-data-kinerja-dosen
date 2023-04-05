(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#nav_active .navbar-nav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    
})(jQuery);
