<?php


namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Beaming a message to slack', [
            'message' => $message
        ]);
//        if ($this->logger) {
//            $this->logger->info('Beaming a message to slack');
//        }

        $slackMessage = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message)
        ;

        $this->slack->sendMessage($slackMessage);
    }
}