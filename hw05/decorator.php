<?php

interface INotifier
{
    public function sendMessage();
}

class BaseNotifier implements INotifier
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function sendMessage(): string
    {
        return $this->message;
    }
}

abstract class Decorator implements INotifier
{
    protected $notifier = null;

    public function __construct(INotifier $notifier)
    {
        $this->notifier = $notifier;
    }
}

class Sms extends Decorator
{
    public function sendMessage(): string
    {
        return $this->notifier->sendMessage() .';'. 'logic for sending sms';
    }
}

class Email extends Decorator
{
    public function sendMessage(): string
    {
        return $this->notifier->sendMessage() .';'. 'logic for sending email';
    }
}

class Cn extends Decorator
{
    public function sendMessage(): string
    {
        return $this->notifier->sendMessage() .';'. 'logic for sending Chrome Notification';
    }
}

function sendMessage(string $message): string
{
    $notifier =
        new Sms(
            new Email(
                new Cn(
                    new BaseNotifier($message)
                )
            )
        );
    return $notifier->sendMessage();
}

echo sendMessage('test message');

