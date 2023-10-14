(function (jQuery) {


    "use strict";

    jQuery(document).ready(function () {

        function convertPhoneNumber($region='Indonesia', $num) {
            switch ($region) {
                case 'Indonesia':
                    return '+62' + $num
                    break;
                default:
                    return '+62' + $num
                    break;
            }
        }
    })
})
