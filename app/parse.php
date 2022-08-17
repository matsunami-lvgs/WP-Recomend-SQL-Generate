<?php
class Parse
{
    public function parse_array($arr)
    {
        $ans = 'a:' . count($arr) . ':{';
        foreach ($arr as $key => $value) {
            $ans .= is_int($key) ? $this->parse_integer($key) : '';
            $ans .= is_string($key) ? $this->parse_string($key) : '';

            $ans .= is_array($value) ? $this->parse_array($value) : '';
            $ans .= is_int($value) ? $this->parse_integer($value) : '';
            $ans .= is_string($value) ? $this->parse_string($value) : '';
        }
        $ans .= '}';
        return $ans;
    }

    private function parse_string(string $str)
    {
        return 's:' . strlen($str) . ':"' . $str . '";';
    }

    private function parse_integer(int $int)
    {
        return 'i:' . $int . ';';
    }
}
