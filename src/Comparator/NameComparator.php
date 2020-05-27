<?php

namespace Comparator;

use Contract\ComparatorInterface;
use Model\Entity\Product;


class NameComparator implements ComparatorInterface
{
/**
 * @param Product $a
 * @param Product $b
 * @return int
 */

public  function compare($a, $b): int
{
    return $a->getName() <=> $b->getName();
}
}