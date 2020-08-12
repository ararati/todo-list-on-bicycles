<?php

namespace App\Core\Http\Validation;

use App\Core\Http\Request;

abstract class Validation
{
    private $processingValue;

    const ERROR_LENGTH_MESSAGE = 'The entered text length is incorrect';

    const ERROR_MAIL_MESSAGE = 'The entered mail is incorrect';

    abstract public function check(Request $request);

    public function checkValue($value)
    {
        $this->processingValue = $value;

        return $this;
    }

    public function min($minLength)
    {
        return $this->handle(
            strlen($this->processingValue) >= $minLength,
            self::ERROR_LENGTH_MESSAGE
        );
    }

    public function max($maxLength)
    {
        return $this->handle(
            strlen($this->processingValue) <= $maxLength,
            self::ERROR_LENGTH_MESSAGE
        );
    }

    public function mail()
    {
        $isValid = filter_var($this->processingValue,FILTER_VALIDATE_EMAIL) !== false;

        return $this->handle($isValid, self::ERROR_MAIL_MESSAGE);
    }

    protected function handle($ruleResult, string $messageOnError)
    {
        if(!$ruleResult)
            $this->fail($messageOnError);

        return $this;
    }

    private function fail($message)
    {
        $this->redirectBack($message);
    }

    protected function redirectBack($errorMessage)
    {
        $this->resolveRedirect($this->resolveBackUrl().'?error='.$errorMessage);
    }

    private function resolveRedirect($url)
    {
        header('Location: ' . $url);
        die();
    }

    private function resolveBackUrl()
    {
        return strtok($_SERVER['HTTP_REFERER'], '?');
    }
}