<?php

namespace Controllers;

use Lib\Verify;

class Contacts_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct(get_class(),
            'contact', '/views/contacts/');
    }

    public function index()
    {
        $new_contact_entry_id = -1;
        $redirect = (__FUNCTION__);
        $new_contact_entry_id = 0;

        $message = "";
        if ( ! empty( $_POST['name'] ) || ! empty( $_POST['email'] ) || ! empty( $_POST['subject'] ) || ! empty( $_POST['text'] )) {

            if( empty( $_POST['name'] ) ) {
                $message .= "<br> Name not provided";
            }

            if ( ! Verify::is_mail_valid( $_POST['email'] )) {
                $message .= "<br> Email does not meet criteria";
            }

            if( empty( $_POST['email'] ) ) {
                $message .= "<br> Email not provided";
            }

            if ( empty( $_POST['subject'] )) {
                $message .= "<br> Subject not provided";
            }

            if ( empty( $_POST['text'] )) {
                $message .= "<br> Text not provided";
            }

        } else if ( ! empty( $_POST['name'] )
            && ! empty( $_POST['email'] )
            && ! empty( $_POST['subject'] )
            && ! empty( $_POST['text'] )) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $text = $_POST['text'];

            $contact = array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'text' => $text,
            );

            $new_contact_entry_id = $this->model->add( $contact );

            if( $new_contact_entry_id > 0 ){
                $redirect = "thanks";
            }

            if($new_contact_entry_id > 0 ){
                $to      = $email;
                $subject = 'RE: on your comment at www.gmanov.com';
                $message = 'Thank you ' . $name . ', for your message :)';
                $headers = 'From: georgimanov@gmail.com' . "\r\n" .
                    'Reply-To: georgimanov@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }
        }

        if( $new_contact_entry_id > 0 ){
            $redirect = "thanks";
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . $redirect . '.php';

        include_once $this->layout;
    }

    public function admin()
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $contacts = $this->model->find();

        if( empty( $contacts) ){
            $this->sorry("No contacts were found!");
            exit;
        }
        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }
}
