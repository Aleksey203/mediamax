/**
 * Created by Оксана и Алексей on 04.04.15.
 */

$(document).ready(function () {

    setInterval( monitor , 5000);

    function monitor() {
        $.ajax({
            url: document.location,
            dataType: 'json',
            success: function (data) {
                if (data.html) $("#box").prepend(data.html);
            }
        });
    }

});
