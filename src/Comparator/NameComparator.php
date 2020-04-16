<?php
use Contract\ComparatorInterface;
use Model\Entity\Product;

class NameComparator implements ComparatorInterface
{

    public function compare($a, $b): int
    {
        return strnatcmp($a->getName(), $b->getName());
    }
}