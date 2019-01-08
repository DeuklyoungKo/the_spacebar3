<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-08
 * Time: 오후 3:32
 */

namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{

    use LoggerTrait;
    /**
     * @var Client
     */
    private $slack;



    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $form, string $message)
    {
        $this->logInfo('Beaming a message to Slack! trait',[
            'message'=>$message
        ]);

        $message = $this->slack->createMessage()
            ->from($form)
            ->withIcon(':ghost:')
            ->setText($message);

        $this->slack->sendMessage($message);
    }


}