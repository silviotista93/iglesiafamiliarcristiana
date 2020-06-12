<?php

namespace MailPoetVendor\Egulias\EmailValidator\Validation\Error;

if (!defined('ABSPATH')) exit;


use MailPoetVendor\Egulias\EmailValidator\Exception\InvalidEmail;
class SpoofEmail extends \MailPoetVendor\Egulias\EmailValidator\Exception\InvalidEmail
{
    const CODE = 998;
    const REASON = "The email contains mixed UTF8 chars that makes it suspicious";
}
