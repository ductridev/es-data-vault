<?php
namespace ES_DataVault\Logger;

use ES_DataVault\Admin\Admin;
use ES_DataVault\Helper\Enum;

abstract class Level extends Enum
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
};

class Logger
{

    private string $Logger_name;

    private string $level;

    private string $file_path;

    private array $format;

    private string $instance;

    /**
     * Initializes the logger
     * 
     * @param string $Logger_name Name of the logger
     * @param string $level Level of the message
     * @param string $file_path Path to the log file
     * 
     * @return void
     */
    public function __construct($Logger_name = "", $file_path = "", $level = Level::INFO, $instance)
    {
        $this->set_logger_name($Logger_name);
        $this->set_level($level);
        $this->set_file_path($file_path);
        $this->set_instance($instance);
    }

    /**
     * Sets the logger's name
     * @param string $Logger_name Name of the logger
     * 
     * @return void
     */
    protected function set_logger_name($Logger_name = "")
    {
        $this->Logger_name = $Logger_name;
    }

    /**
     * Get the logger's name
     * 
     * @return string Name of the logger
     */
    public function get_logger_name()
    {
        return $this->Logger_name;
    }

    /**
     * Set the logger's level
     * @param string $level Lowest level the logger will be logged at
     * 
     * @return void
     */
    protected function set_level($level = Level::INFO)
    {
        $this->level = $level;
    }

    /**
     * Get the logger's level
     * 
     * @return string
     */
    public function get_level()
    {
        return $this->level;
    }

    /**
     * Set the logger's file path
     * @param string $file_path File path to write
     * 
     * @return void
     */
    protected function set_file_path($file_path = "")
    {
        $this->file_path = $_ENV['ROOT_PATH'] . !empty($file_path) ? $file_path : 'logs/';
    }

    /**
     * Get the logger's file path
     * 
     * @return string File path of the logger
     */
    public function get_file_path()
    {
        return $this->file_path;
    }

    /**
     * Get the file's name where log will be written into
     * 
     * @return string File's name where log will be written into
     */
    public function get_file_name()
    {
        return 'combined-' . date('Y.m.d') . '.log';
    }

    private function set_instance($instance){
        $this->instance = $instance;
    }

    /**
     * Set the logger's format
     * @param array $format Format array contains how datetime will be look like, orders of datetime, instance's name, level and message
     * 
     */
    protected function set_format($format = array(
        'datetime' => 'd-M-Y H:i:s T',
        'orders' => array('datetime', 'instance', 'level', 'message')
    ))
    {
        $this->format = $format;
    }

    /**
     * Get the logger's format
     * 
     * @return array Format array contains how datetime will be look like, orders of datetime, instance's name, level and message
     */
    public function get_format()
    {
        return $this->format;
    }

    /**
     * Format the message according to the format specified in the format array passed through set_format() method
     * 
     * @return string String message will be written into log file
     */
    private function format($message = '', $level = Level::INFO)
    {
        return '[' . date($this->format['datetime']) . '] [' . $this->instance . '] [' . $level . '] : ' . $message;
    }

    /**
     * Log the message with level and instance's name into log file.
     */
    public function log_message($message = '', $level = Level::INFO)
    {
        if($level == Level::INFO)
        if (file_put_contents($this->get_file_path() . '/'. $this->instance. '/' . $this->get_file_name(), $this->format($message, $level, $this->instance), FILE_APPEND)) {
            return true;
        }
        return false;
    }

    /**
     * Send notice to admin if Level is Error or above.
     * @param string $message
     * @param string $level
     * @param string $instance
     * 
     * @return bool True if notice is sent, false otherwise
     */
    private function notice_admin($message, $level = Level::ERROR, $instance){
        if(Level::ifBigger($level, Level::ERROR)){
            Admin::send_mail_to_admin();
            Admin::send_notice_to_admin();
        }
    }
};
