<?php
class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $emailSent = false;
        $hasError = false;

        $form = new Form;
        $form->load(CONFIG . "form.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = stripslashes(trim($_POST['form-name']));
            $email   = stripslashes(trim($_POST['form-email']));
            $phone   = stripslashes(trim($_POST['form-phone']));
            $subject = stripslashes(trim($_POST['form-subject']));
            $message = stripslashes(trim($_POST['form-message']));
            $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

            if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
                die("Header injection detected");
            }

            $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($name && $email && $emailIsValid && $subject && $message) {
                $mail = new Simplemail();

                $mail->setTo($form->get('emails.to'));
                $mail->setFrom($form->get('emails.from'));
                $mail->setSender($name);
                $mail->setSenderEmail($email);
                $mail->setSubject($form->get('subject.prefix') . ' ' . $subject);

                $body = "
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset=\"utf-8\">
                    </head>
                    <body>
                        <h1>{$subject}</h1>
                        <p><strong>{$form->get('fields.name')}:</strong> {$name}</p>
                        <p><strong>{$form->get('fields.email')}:</strong> {$email}</p>
                        <p><strong>{$form->get('fields.phone')}:</strong> {$phone}</p>
                        <p><strong>{$form->get('fields.message')}:</strong> {$message}</p>
                    </body>
                </html>";

                $mail->setHtml($body);
                $mail->send();

                $emailSent = true;
            } else {
                $hasError = true;
            }
        }

        $data['breadcrumb'] = $this->breadcrumb->build(
            array(
                'Contact' => 'contact',
            )
        );

        $data['title'] = 'Our <b>Cats Contact</b>';
        $data['form'] = $form;
        $data['emailSent'] = $emailSent;
        $data['hasError'] = $hasError;
        
        $this->_view->render('contact/index', $data);

    }

    // public function index()
    // {
    //     $data['title'] = 'Our <b>Cats Contact</b>';
    //     $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
    //     $this->_view->render('home/contact', $data);
    // }
}








