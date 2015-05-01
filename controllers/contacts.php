<?php

namespace Controllers;

class Contacts_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct(get_class(),
            'contact', '/views/contacts/');
    }

    public function index()
    {
        $new_contact_entry_id = -1;

        if( ! empty( $_POST['name'] )
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

            if($new_contact_entry_id > 0 ){
                $to      = $email;
                $subject = 'RE: on your comment at www.gmanov.com';
                $message = 'Thank you' . $name . ', for your message :)';
                $headers = 'From: georgimanov@gmail.com' . "\r\n" .
                    'Reply-To: georgimanov@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }
        }

        $redirect = (__FUNCTION__). '.php';
        if( $new_contact_entry_id > 0 ){
            $redirect ='thanks.php';
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . $redirect;

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
