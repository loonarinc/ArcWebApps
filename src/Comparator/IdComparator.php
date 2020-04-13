<?php
namespace Comparator;

use Contract\ComparatorInterface;
use Model\Entity\Product;

class IdComparator implements ComparatorInterface
{

    public function compare($a, $b): int
    {
        return $a->getId() <=> $b->getId();
    }
}