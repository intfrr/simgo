<?php
/**
 * Simgo
 *
 * Library simple and sexy.
 * This is a simple and attractive library will help you to write php code more clear and easy!
 *
 * @package     Simgo
 * @version     1.0
 *
 * @author      Jose Pino / Fraph <jofpin@gmail.com>
 * @copyright   2014 Jose Pino / @jofpin
 *
 * This is the main source of simgo file.
 * For full copyright information and documentation of this visit: http://jofpin.github.io/simgo
 */

class simgo {
    /**
     * Protected constructor since this is a static class. now you know!
     * All functions that are within the class (simgo) are the support of the independent bookstore features!
     * The class will only be support functions.
     *
     * @access  protected
     */
    protected function __construct() {
        //// There is nothing here, only the invisible man :D
    }

    /**
     * simgo::VERSION & simgo::AUTHOR > pure documentation and property!
     * They serve as a support to functions version() and author()
     */

    /**
     * The author of Simgo
     * To identify copyright!
     * 
     * @example go(simgo::AUTHOR);
     * @var string
     */
    const AUTHOR = "Jose Pino";

    /**
     * This is only for document
     * The version of Simgo
     *
     * @example go(simgo::VERSION);
     * @var string
     */
    const VERSION = "1.0";

    /**
     * This is simple happy code.
     * This gives you a push requests sexy GET and POST.
     * support for functions get() & post()
     * Returns value from core using dot notation.
     * If the key does not exist in the array, the default value will be returned instead. :D
     *
     * @example simgo::request($_GET, "test");  for get()
     * @example simgo::request($_POST, "test"); for post()
     *
     * @param  array  $array to extract from (Array)
     * @param  string $path  path (Array)
     * @param  mixed  $core Default (Array)
     */
    public static function request($array, $path, $core = null) {
        // segments > segms Get segments from path
        $segms = explode(".", $path);

        foreach ($segms as $segm) { // Loop through segments

            // Checking
            if ( ! is_array($array) || !isset($array[$segm])) {
                return $core;
            }

            $array = $array[$segm];
        }

        return $array;
    }

    /**
     * Protection of email to prevent spam-bots and sniff.
     *
     * Making random each of the values to hexadecimal
     * This will keep confused bots that try to sniff
     * This function is a support function for "email()" and play!
     *
     * @example go(simgo::hexmailer("test@test.com")); is optional better to use function email()!
     *
     * @param  string  $value_unique
     * @return string
     */
    public static function hexmailer($value_unique) {

        $secure = "";

        foreach (str_split($value_unique) as $printed) {
            switch(rand(1, 3)) {
                case 1:
                    $secure .= "&#".ord($printed).";";
                break;
                case 2:
                    $secure .= "&#x".dechex(ord($printed)).";";
                break;
                case 3:
                    $secure .= $printed;
            }
        }

        return $secure;
    }

    /**
     * Convert special characters to HTML entities.
     * Trick to avoid the injections and XSS execution (Sanitize).
     * This function is the clean() support!
     *
     *
     * @example simgo::xssFix("<script>alert(1337);</script>");
     *
     * @param  boolean $encode Encode existing entities
     * @param  string  $value  String to convert
     * @return string
     */
    public static function xssFix($value, $encode = true) {
        return htmlentities((string) $value, ENT_QUOTES, "utf-8", $encode);
        // return go(htmlspecialchars($string, ENT_QUOTES, "utf-8"));
    }

    /**
     * This is to prevent (null) character between ascii characters.
     * remove Invisible Characters!
     * Seriously this help too!
     * function support for clean() connected to xssFix()
     *
     * @param string $string
     */
    public static function recii($string) {
        // no displayables
        $noyables = array('/\x0b/','/\x0c/','/%1[0-9a-f]/','/[\x00-\x08]/','/[\x0e-\x1f]/','/%0[0-8bcef]/');
        
        do {
            $clean = $string;
            $string = preg_replace($noyables, "", $string);
        } while ($clean != $string);

        return $string;
    }

}

    /**
    * 
    * Game of functions  (Simgo)
    * Functions: go, clean, goHeader, redirect, post, get, ajax, email, baseURL, currentURL, version & author!
    *
    */

    /**
     * Sanitize data to prevent (XSS) - Cross-site scripting!
     * XSS information: (http://wikipedia.org/wiki/Cross-site_scripting)
     *
     * @example $var = clean("<script>alert(1337);</script>");
     * @example go(clean("<script>alert(1337);</script>"));  > For this you better use the function goClean();
     *
     * @param string $string
     */
    function clean($string) {
        // Convert html to plain text & Remove invisible characters
        $string = simgo::recii($string);
        $string = simgo::xssFix($string); 

        return $string;
    }

    /**
     * clean with go!
     *
     * @example goClean("<script>alert(1337);</script>");
     *
     * @param string $string
     */
    function goClean($string) {
        $string = simgo::recii($string);
        $string = simgo::xssFix($string); 

        // go on here :-)
        return go($string);
    }

    /**
     * Insert text or html!
     * Pull "echo or print" in the trash!
     * Add a (go) into your life with php :D
     *
     * @example go("content here");
     *
     * @param  string $string
     * @return string
     */
    function go($string) {
        return print($string);
    }

    /**
     * Customization and replacement of header() by goHeader()
     * For the use and support of the redirect() function
     *
     * @example goHeader("X-Frame-Options: DENY");
     * @example goHeader("Location: http://example.com");
     *
     * @param mixed $hds string or array with headers to send.
     * @param mixed $hds is headers
     */
    function goHeader($hds) {
        foreach ((array) $hds as $header) {
            // Run Header
            header((string) $header);
        }
    }

    /**
     * Set one or multiple headers.
     * Redirects page sexy to a page specified by the $url argument.
     *
     * @example redirect("http://example.com/");
     * @example redirect("test");
     *
     * @param string  $url_value The URL
     * @param integer $status Status Code
     * @param integer $delay  Delay
     */
    function redirect($url_value, $status = 302, $delay = null) {
        // Redefine Vars
        $status = (int) $status;
        $url_value = (string) $url_value;

        // Values of status code
        $msg_value = array();
        $msg_value[301] = "301 Moved Permanently";
        $msg_value[302] = "302 Found";

        // Sent headers game
        if (headers_sent()) {

            go("<script>document.location.href='" . $url_value . "';</script>\n");

        } else {
            // Redirection header
            goHeader("HTTP/1.1 " . $status . " " . get($msg_value, $status, 302));
            // Delay execution
            if ($delay !== null) sleep((int) $delay);
            // Redirect ok
            goHeader("Location: $url_value");
        }

    }

    /**
     * Functions for POST & GET requests
     *
     * @param mixed
     */

    /**
     * POST
     *
     * @example $var = post("test");
     * @example go(post("test")); > For this you better use the function goPost();
     *
     * @param string $param (parameter) > Key
     */
    function post($param) {
        return simgo::request($_POST, $param);
    }

    /**
     * POST with go!
     *
     * @example goPost("test");
     *
     */
    function goPost($param) {
        return go(simgo::request($_POST, $param));
    }


    /**
     * GET
     *
     * @example $var = get("test");
     * @example go(get("test")); > For this you better use the function goGet();
     *
     * @param string $param (parameter) > Key
     */
    function get($param) {
        return simgo::request($_GET, $param);
        //return go(simgo::request($_GET, $param));
    }

    /**
     * GET with go!
     *
     * @example goGet("test");
     *
     */
    function goGet($param) {
        return go(simgo::request($_GET, $param));
    }

    /**
     * Returns whether this is an ajax request or not (is Ajax)
     *
     * @example
     *      if (ajax()) {
     *         // your code here!
     *      }
     *
     * @return boolean
     */
    function ajax() {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === 'XMLHttpRequest';
    }

    /**
     * Protection of email to prevent spam-bots and sniff.
     * This is really sexy, already you know ;)
     * This is the stand that receives the function hidemailer() to do magic
     *
     * @example  $var = email("test@test.com");
     * @example  go(email("test@test.com")); > For this you better use the function goEmail();
     *
     * @param  string  $email
     * @return string
     */
    function email($mail) {
         return str_replace("@", "&#64;", simgo::hexmailer($mail));
     }

    /**
     * email with go!
     *
     * @example  goEmail("test@test.com");
     *
     * @param  string  $email
     * @return string
     */
    function goEmail($mail) {
         return go(str_replace("@", "&#64;", simgo::hexmailer($mail)));
     }

    /**
     * Gets current URL -_-
     *
     * @example go(currentUrl());
     *
     * @return string
     */
    function currentUrl() {
        return (!empty($_SERVER["HTTPS"])) ? "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] : "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }

    /**
      * Gets the base URL -_-
      *
      * @example go(baseUrl());
      *
      * @return string
     */
    function baseUrl() {
        $base = (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on") ? 'https://' : 'http://';
        return clean($base . rtrim(rtrim($_SERVER["HTTP_HOST"], '\\/') . dirname($_SERVER["PHP_SELF"]), '\\/'));
    }

    /**
      *
      * author(); & version(); functions are to document!!!
      *
     */

    /**
      * Version simgo
      * It is not necessary to use this in your development. Now you know!
      *
      * @example $var = version();
      * @example go(version()); > For this it uses goVersion() and will be more beautiful!
      *
     */
    function version() {
        // value simgo version
        $value = simgo::VERSION;

        // Return value
        return $value;
    }


    /**
      * Version simgo
      * version() with (go) = goVersion();
      *
      * @example goVersion();
      *
     */
    function goVersion() {
        // value simgo version
        $value = simgo::VERSION;

        // Return value
        return go($value);
    }

    /**
      * Author simgo
      * It is not necessary to use this in your development. Now you know!
      *
      * @example $var = author();
      * @example go(author()); > For this it uses goAuthor() and will be more beautiful
      *
     */
    function author() {
        // value simgo author
        $value = simgo::AUTHOR;

        // Return value
        return $value;
    }

    /**
      * Author simgo
      * author() with (go) = goAuthor();
      *
      * @example goAuthor();
      *
     */
    function goAuthor() {
        // value simgo author
        $value = simgo::AUTHOR;

        // Return value
        return go($value);
    }

    // This will continue...
