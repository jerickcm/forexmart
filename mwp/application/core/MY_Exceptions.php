<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extending the default errors to always give JSON errors
 *
 * @author Oliver Smith
 */

class MY_Exceptions extends CI_Exceptions
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 404 Page Not Found Handler
     *
     * @param   string  the page
     * @param   bool    log error yes/no
     * @return  string
     */
    function show_404($page = '', $log_error = TRUE)
    {
        // By default we log this, but allow a dev to skip it
//        if ($log_error)
//        {
//            log_message('error', '404 Page Not Found --> '.$page);
//        }
//
//        header('Cache-Control: no-cache, must-revalidate');
//        header('Content-type: application/json');
//        header('HTTP/1.1 404 Not Found');
//
//        echo json_encode(
//            array(
//                'status' => FALSE,
//                'error' => 'Unknown method',
//            )
//        );

        require APPPATH . 'views/errors/html/error_404.php';

        exit;
    }

    /**
     * General Error Page
     *
     * This function takes an error message as input
     * (either as a string or an array) and displays
     * it using the specified template.
     *
     * @access  private
     * @param   string  the heading
     * @param   string  the message
     * @param   string  the template name
     * @param   int     the status code
     * @return  string
     */
    function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
//        ob_end_clean();
//        $ci =& get_instance();
//        if (!$page = $ci->uri->uri_string()) {
//            $page = 'home';
//        }
        log_message('error', 'Error500[' . $_SERVER['REMOTE_ADDR'] . ']: ' . '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>');
        require APPPATH . 'views/errors/html/error_php_custom.php';

        echo "<script>console.log('error message: " , '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>' , "');</script>";
        exit();
    }

    /**
     * Native PHP error handler
     *
     * @access  private
     * @param   string  the error severity
     * @param   string  the error string
     * @param   string  the error filepath
     * @param   string  the error line number
     * @return  string
     */
    function show_php_error($severity, $message, $filepath, $line)
    {
//        ob_end_clean();
//        $ci =& get_instance();
//        if (!$page = $ci->uri->uri_string()) {
//            $page = 'home';
//        }
        if(!in_array($severity, array(E_NOTICE, E_WARNING, E_PARSE))) {
            log_message('error', 'Error500[' . $_SERVER['REMOTE_ADDR'] . '] Severity: ' . $severity . ' --> ' . $message . ' ' . $filepath . ' ' . $line);
            require APPPATH . 'views/errors/html/error_php_custom.php';

            echo "<script>console.log('severity: " , $severity , "');</script>";
            echo "<script>console.log('message: " , $message , "');</script>";
            echo "<script>console.log('filepath: " , $filepath , "');</script>";
            echo "<script>console.log('line number: " , $line , "');</script>";
            exit();
        }
//        header('Cache-Control: no-cache, must-revalidate');
//        header('Content-type: application/json');
//        header('HTTP/1.1 500 Internal Server Error');
//
//        echo json_encode(
//            array(
//                'status' => FALSE,
//                'error' => 'Internal Server Error',
//            )
//        );
//
//        exit;
    }
}

?>