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
 * calculator_history block.
 *
 * @package    block_calculator_history
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_calculator_history extends block_base {
    
     /**
     * Core function used to initialize the block.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_calculator_history');
    }
    
    /**
     * Used to generate the content for the block.
     * @return string
     */
    public function get_content() {
        global $DB, $USER;
        
        // Checking whether configuration of block is set.
        if (isset($this->config->select)) {
            
            // Store the value selected from the drop down while configuration block.
            $limit = $this->config->select;
            
            // Fetching data from database for particular user and limit set by user.
            $data = $DB->get_records_sql("SELECT expression, result "
                                       . "FROM {block_calculator_history} "
                                       . "WHERE userid = '".$USER->id."' "
                                       . "ORDER BY id DESC "
                                       . "LIMIT 0,$limit");
        }
        
        if ($this->content !== null) {
            return $this->content;
        }
            $this->content = new stdClass();
            $this->content->text = '';

        // This is for printing the data in block body.
        if (!empty($data)) {
            $i = 1;
            foreach ($data as $key => $value) {
                $this->content->text .= "(<span style=color:red;> $i </span>). <span style=color:blue;> ". $value->expression." = ".$value->result."<br> </span>";
                $i++;
            }
        } else {
            
            // When we add this block, it will show below message in block's body.
            $this->content->text = "Need to configure this block for data.";
        }
           return $this->content;
    }
    
    /**
     * Allows the block to be added multiple times to a single page
     * @return boolean
     */
    public function instance_allow_multiple() {
        return true;
    }
    
    /**
     * Core function, specifies where the block can be used.
     * @return array
     */
    public function applicable_formats() {
        return array('all' => true,
                     'site' => false
                    );
    }
}