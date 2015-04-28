/**
 * Created by Оксана и Алексей on 04.04.15.
 */


var myDataRef = new Firebase('https://sweltering-heat-5744.firebaseio.com/');

myDataRef.on('child_added', function(snapshot) {
    $.ajax({
        url: document.location,
        dataType: 'json',
        success: function (data) {
            if (data.html) $("#box").prepend(data.html);
        }
    });
});
