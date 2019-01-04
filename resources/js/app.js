
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// calculate dive time on realtime.
$("#timeEntry").on('click', function() {
    calDiveTime();
});

var calDiveTime = function() {
    var $timeEntry = $('#timeEntry').val();
    var $timeExit = $('#timeExit').val();
    if (isset($timeEntry) && isset($timeExit)) {
        var timeDive = $timeExit - $timeEntry;
        var result2 = timeMath.sub('12:34', '00:12');
        console.log(result2);
        console.log($timeExit);
        console.log($timeEntry);
        console.log(timeDive);
        $('#timeDive').val(timeDive);
    }
}

var isset = function(data){
    if(data === "" || data === null || data === undefined){
        return false;
    }else{
        return true;
    }
};
