//
// * Javascript
// *
// * @package    ajaxdemo
// * Developer: 2020 Ricoshae Pty Ltd (http://ricoshae.com.au)
//

require(['core/first', 'jquery', 'jqueryui', 'core/ajax'], function(core, $, bootstrap, ajax) {

  // -----------------------------
  $(document).ready(function() {

    //  toggle event
    $('#id_courses').change(function() {
      // get current value then call ajax to get new data
      var selectedcourseid = $('#id_courses').val();
      ajax.call([{
        methodname: 'local_ajaxdemo_getteachersincourse',
        args: {
          'id': selectedcourseid
        },
      }])[0].done(function(response) {
        // clear out old values
        $('#id_teachers').html('');
        var data = JSON.parse(response);
        for (var i = 0; i < data.length; i++) {
          $('<option/>').val(data[i].id).html(data[i].firstname + ' ' + data[i].lastname).appendTo('#id_teachers');
        }
        setnewvalue();
        return;
      }).fail(function(err) {
        console.log(err);
        //notification.exception(new Error('Failed to load data'));
        return;
      });

    });

    $('#id_teachers').change(function() {
      setnewvalue();
    });

    function setnewvalue() {
      console.log($('#id_teachers').val());
      $('input[name = teacherid]').val($('#id_teachers ').val());
    }

  });
});