<?php

namespace ES_DataVault\Admin;

use ES_DataVault\Logger\Level;

class Admin
{
    /**
     * Send a mail to the admin to notice about the error that effect majority to the application.
     */
    public static function send_mail_to_admin($message = '', $level = Level::ERROR, $instance = '')
    {
        global $Logger_admin;

        $admin_mails = self::get_admin_mail();
        foreach ($admin_mails as $admin_mail) {
            $headers  = "From: " . $admin_mail . "\r\n";
            $headers .= "Reply-To: " . $admin_mail . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $result = mail($admin_mail, strtoupper($level) . ': ' . $instance, '<div><h1>Notice!</h1></div><div>Hi admin, there is something happening and cause error(s) for instance: ' . $instance . '.</div><div>This is an error message: ' . $message . '.</div><div><h3>Need to fix immediately!<h3/></div>', $headers);
            if (!$result) {
                $Logger_admin->log_message("Cannot send notice mail to admin with mail get from database.", Level::ERROR, 'admin');
                $Logger_admin->log_message("Get admin's mail failed reason: " . error_get_last()['message'], Level::DEBUG, 'admin');
            }
        }
    }

    /**
     * Currently in development
     */
    public static function send_notice_to_admin()
    {
    }

    /**
     * Get admin's mail get from database
     */
    private static function get_admin_mail(): array
    {
        global $db, $Logger_admin;

        $admin_mails = array();

        if ($result = $db->query("SELECT * FROM admin WHERE email = 1")) {
            while ($row = $result->fetch_assoc()) {
                $admin_mails[] = $row['mail'];
            }
        } else {
            $Logger_admin->log_message("Cannot get admin's mail from database.", Level::ERROR, 'admin');
            $Logger_admin->log_message("Get admin's mail failed reason: " . $db->error, Level::DEBUG, 'admin');
        }
        return $admin_mails;
    }
}
