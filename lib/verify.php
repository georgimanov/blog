<?php

namespace Lib;

class Verify
{
    public static function is_mail_valid ( $email ) {

        if ( strlen ( $email ) < 6 || strlen ( $email ) > 45 ) {

            return false;
        }

        if ( ! empty ( $email ) ) {

            // regular expression for email check
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';

            if ( ! preg_match ( $regex, $email ) ) {

                return false;
            }

            return true;
        }
    }

    public static function sanitize_tag ($tag){
        $tag_name = $tag;
        $tag_name = trim($tag_name);

        // Remove all characters except A-Z, a-z, 0-9, dots, hyphens and spaces
        // Note that the hyphen must go last not to be confused with a range (A-Z)
        // and the dot, being special, is escaped with \
        $tag_name = preg_replace('/[^A-Za-z0-9\. -]/', '', $tag_name);

        // Replace sequences of spaces with single space
        $tag_name = preg_replace('/\\s+/', ' ', $tag_name);

        return $tag_name;
    }
}