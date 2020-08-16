<?php

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

/**
 * External Web Service Template
 *
 * @package    Externallib
 * Developer: 2020 Ricoshae Pty Ltd (http://ricoshae.com.au)
 */


require_once($CFG->libdir . "/externallib.php");

class local_ajaxdemo_external extends external_api
{

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function getteachersincourse_parameters()
    {
        return new external_function_parameters(
          array("id" => new external_value(PARAM_INT, "id"))
        );
    }

    /**
     * Returns welcome message
     * @return array = array('' => , ); welcome message
     */
    public static function getteachersincourse($id)
    {
        global $USER;
        global $DB;
        global $CFG;

        //$context = context_system::instance();
        // $context = context_user::instance($USER->id);
        // self::validate_context($context);

        $params = self::validate_parameters(
            self::getteachersincourse_parameters(),
                array('id'=>$id)
        );

        $role = $DB->get_record('role', array('shortname' => 'editingteacher'));
        $context = CONTEXT_COURSE::instance($id);
        $teachers = get_role_users($role->id, $context, true);

        return json_encode(array_values($teachers));
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function getteachersincourse_returns()
    {
        return new external_value(PARAM_RAW, 'The updated JSON output');
//        return new external_value();//new external_value(PARAM_TEXT, 'The welcome message + user first name');
    }

}
