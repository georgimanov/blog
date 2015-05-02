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
}