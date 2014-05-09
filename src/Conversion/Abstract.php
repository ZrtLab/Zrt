<?php

interface Zrt_Conversion
{

    public function Open($options);

    public function Close();

    public function Write($data);

    public function Read();

    public function ListWrite($data, $tranlate = null);

    public function ListRead();
}
