/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var moment = require('moment');

/**
 * Calculate dive time on realtime.
 */

$("#timeEntry").on('click change', function () {
    calDiveTime();
});
$("#timeExit").on('click change', function () {
    calDiveTime();
});

var calDiveTime = function () {
    var timeEntry = moment('2019-01-01 ' + $('#timeEntry').val());
    var timeExit = moment('2019-01-01 ' + $('#timeExit').val());
    if (isset(timeEntry) && isset(timeExit)) {
        var timeDive = timeExit.diff(timeEntry, 'minutes');
        $('#timeDive').val(timeDive);
    }
}

/**
 * isset function
 */

var isset = function (data) {
    if (data === "" || data === null || data === undefined) {
        return false;
    } else {
        return true;
    }
};
