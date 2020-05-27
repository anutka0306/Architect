<?php


namespace Service\Product;

use Contract\ComparatorInterface;
use Model\Entity\Product;

class ProductSorter
{
/**
 * @var ComparatorInterface
 */
private $comparator;

/**
 * ProductSorter constructor.
 * @param ComparatorInterface $comparator
 */

public function __construct(ComparatorInterface $comparator)
{
    $this->comparator = $comparator;
}

/**
 * @param Product[] $products
 * @return Product[]
 */

public function sort(array $products): array {
    usort($products, [$this->comparator,'compare']);
    return $products;
}

}