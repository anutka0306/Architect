<?php


namespace Contract;


interface ComparatorInterface
{
/**
 * @param $a
 * @param $b
 * @return int
 */
public function compare($a, $b): int;
}