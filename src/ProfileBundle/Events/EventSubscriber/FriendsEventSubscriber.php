<?php


namespace ProfileBundle\Events\EventSubscriber;


use ProfileBundle\Events\EventDispatcher\Friends\FriendsEvent;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FriendsEventSubscriber implements EventSubscriberInterface
{
    private  $mailer;

    public function __construct()
    {}

    public function sendInvitation(FriendsEvent $event){
        //SEND EMAIL
        $transport = new \Swift_SmtpTransport('mail.maleco.es',587);

        $transport->setUsername("maleco@maleco.es");
        $transport->setPassword("LWZOBKYolDxjMCt7G1PJ");

        $mailer = new \Swift_Mailer($transport);

        $email =$event->getEmail();
        $email = str_replace("#","@",$email);
      
        $message = new \Swift_Message();
        $message->setSubject("Invitation to TFM - RED SOCIAL");
        $message->setTo(array($email));
        $message->setFrom("maleco@maleco.com");
        $message->setBody($this->getHtmlEmail());
        $message->setContentType("text/html");

        $mailer->send($message);

    }

    public static function getSubscribedEvents()
    {
        return array(
          FriendsEvent::SENDINVITATION => 'sendInvitation'
        );
    }

    private function getHtmlEmail(){

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
                                        
                                        
                                        You have received an invitation to join the social network, please click on the following link:<br><br>
                                        <a href="http://ec2-34-250-163-229.eu-west-1.compute.amazonaws.com">TFM - RED SOCIAL</a>
                                        
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
