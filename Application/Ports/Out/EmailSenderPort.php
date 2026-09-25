<?php

declare(strict_types=1);

interface EmailSenderPort
{
    public function send(EmailDestinationModel $destination): void;
}
