<?php
namespace Comparator;

use Contract\ComparatorInterface;
use Model\Entity\Product;

class PriceComparator implements ComparatorInterface
{

    public function compare($a, $b): int
    {
        return $a->getPrice() <=> $b->getPrice();
    }
}