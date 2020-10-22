<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


require_once '../../config.php';
global $USER, $DB, $CFG;
require_once("forms/ajaxdemoform.php");

$PAGE->set_url('/local/ajaxdemo/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->requires->js('/local/ajaxdemo/assets/js_ajaxdemo.js');

require_login();

// get id if editing form
$id = optional_param('id', '', PARAM_TEXT);
$delete = optional_param('delete', 0, PARAM_INT);

$obj = new stdClass();

$PAGE->set_title('Ajaxdemo');
$PAGE->set_heading('Ajaxdemo');

if ($delete) {

  // delete record if applicable
    redirect('/', '', 10);
}

  $mform = new ajaxdemo_form();
  $toform = [];
  //Form processing and displaying is done here
  if ($mform->is_cancelled()) {
      //Handle form cancel operation, if cancel button is present on form
      redirect('/', '', 10);
  } elseif ($fromform = $mform->get_data()) {
      //In this case you process validated data. $mform->get_data() returns data posted in form.
      // Save form data
    
      if ($id) {
          // update
          // $data = $DB->get_record('table', ['id'=>$id]);
          // $id->name = $fromform->name;
          // $DB->update_record('table', $data);
      } else {
          // new
          // $id = $DB->insert_record('table', [], true, false);
      }

      //redirect('/', '', 10);
  } else {
      // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
      // or on the first display of the form.
      if ($id) {
          //$toform = $DB->get_record('table', ['id'=>$id]);
      }

      //Set default data (if any)
      $mform->set_data($toform);
      //displays the form
      echo $OUTPUT->header();
      $mform->display();
      echo $OUTPUT->footer();
  }
