<?php

namespace Ante\DnsParser\TXTRecords;

class DKIM1 extends V
{
    protected string $k;
    protected string $p;

    public function __construct(string $value)
    {
        $this->type = 'DKIM';
        $this->version = 1;
        $this->k = $this->cast('k', $value);
        $this->p = $this->cast('p', $value);
    }

    public function castK(string $value): string
    {
        preg_match('/k=([a-zA-Z0-9]+)/', $value, $matches);
        if(count($matches) < 2) {
            return "";
        }

        return str_replace(";", "", $this->prepareText($matches[1]));
    }

    public function castP(string $value): string
    {
        preg_match('/p=([a-zA-Z0-9_\/\+-=]+)/', $value, $matches);
        if(count($matches) < 2) {
            return "";
        }

        return str_replace(";", "", $this->prepareText($matches[1]));
    }
}
