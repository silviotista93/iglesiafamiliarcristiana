<?php

namespace MailPoetVendor\Egulias\EmailValidator\Exception;

if (!defined('ABSPATH')) exit;


class ExpectingDomainLiteralClose extends \MailPoetVendor\Egulias\EmailValidator\Exception\InvalidEmail
{
    const CODE = 137;
    const REASON = "Closing bracket ']' for domain literal not found";
}
