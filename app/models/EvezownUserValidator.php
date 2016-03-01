<?php
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Confide\UserValidatorInterface;

class EvezownUserValidator implements UserValidatorInterface
{

    public function validate(ConfideUserInterface $user)
{
    unset($user->password_confirmation);
    return true;
}
}