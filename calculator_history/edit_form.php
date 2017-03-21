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

/**
 * Form for editing HTML block instances.
 *
 * @package   block_calculator_history
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Form for editing calculator history block instances.
 *
 * @copyright 2009 Tim Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_calculator_history_edit_form extends block_edit_form {
    
     /**
     * The definition of the fields to use.
     *
     * @param MoodleQuickForm $mform
     */
    protected function specific_definition($mform) {
        
        // Taking blank array and passing 50 values in it to have that much history.
        $value = array();
        for ($i = 1; $i <= 50; $i++) {
            $value[$i] = $i;
        }
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block_calculator_history'));
        $mform->addElement('select', 'config_select', get_string('Select', 'block_calculator_history'), $value);
        $mform->setDefault('config_select', 20);
        $mform->setType('config_select', PARAM_RAW);
    }
}
