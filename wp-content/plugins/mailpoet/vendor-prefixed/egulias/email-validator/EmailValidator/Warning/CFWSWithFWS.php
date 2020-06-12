<?php

namespace MailPoetVendor\Egulias\EmailValidator\Warning;

if (!defined('ABSPATH')) exit;


class CFWSWithFWS extends \MailPoetVendor\Egulias\EmailValidator\Warning\Warning
{
    const CODE = 18;
    public function __construct()
    {
        $this->message = 'Folding whites space followed by folding white space';
    }
}
