<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019-01-08
 * Time: 오후 5:25
 */

namespace App\Helper;


use Psr\Log\LoggerInterface;

trait LoggerTrait
{

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    private function logInfo(string $message, array $context = [])
    {
        if($this->logger){
            $this->logger->info($message,$context);
        }
    }
}