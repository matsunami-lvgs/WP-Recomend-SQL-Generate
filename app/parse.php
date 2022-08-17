<?php
class Parse
{
    public function parse_array(array $arr)
    {
        $result = 'a:' . count($arr) . ':{';
        foreach ($arr as $key => $value) {
            $result .= is_int($key) ? $this->parse_integer($key) : '';
            $result .= is_string($key) ? $this->parse_string($key) : '';

            $result .= is_array($value) ? $this->parse_array($value) : '';
            $result .= is_int($value) ? $this->parse_integer($value) : '';
            $result .= is_string($value) ? $this->parse_string($value) : '';
        }
        $result .= '}';
        return $result;
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
