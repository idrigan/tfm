    <?php


namespace ProfileBundle\Events\EventSubscriber;


use ProfileBundle\Events\EventDispatcher\Contact\ContactEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContactEventSubscriber implements EventSubscriberInterface
{

    public function sendContact(ContactEvent $event){

        $transport = new \Swift_SmtpTransport('mail.maleco.es',587);

        $transport->setUsername("maleco@maleco.es");
        $transport->setPassword("LWZOBKYolDxjMCt7G1PJ");


        $mailer = new \Swift_Mailer($transport);

        $message = new \Swift_Message();
        $message->setSubject("Contact from TFM - RED SOCIAL");
        $message->setTo(array("idrigan@gmail.com"));
        $message->setFrom("maleco@maleco.com");
        $message->setBody($this->getHtmlEmail($event->getName(),$event->getEmail(),$event->getMessage()));
        $message->setContentType("text/html");

        $mailer->send($message);

    }

    public static function getSubscribedEvents()
    {
        return array(
          ContactEvent::SENDCONTACT => 'sendContact'
        );
    }

    private function getHtmlEmail($name,$email,$message){

        $html = '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
 
                <html xmlns=\"http://www.w3.org/1999/xhtml\">
 
                    <head>
                     
                    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                     
                    <title>Demystifying Email Design</title>
                     
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
                     
                    </head>
                    <body>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                     <td align="center" style="vertical-align: middle;min-height:400px;">
 
                                        <img src="http://ec2-34-250-163-229.eu-west-1.compute.amazonaws.com/images/img-email.png" alt="TFM - RED SOCIAL" width="100%"  style="display: block;" />
                                     
                                     </td>
                                </tr>
                                <tr>
                                 
                                    <td style="text-align: center;font-size:14px;padding:20px;min-height:200px;">
                                 
                                        Hello!,<br><br>
                                        
                                        
                                        You have received an message from contact:<br><br>
                                        
                                        <label>name: '.$name.'</label><br>
                                        <label>email: '.$email.'</label><br>
                                        <label>message: '.nl2br($message).'</label>
                                        
                                        <br><br>
                                        Thank you !!
                                    </td>
                                 
                                </tr>
                             
                           </table> 
                    </body>
                 
                </html>';

        return $html;
    }

}
