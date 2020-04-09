<?php

namespace Facade;

use Service\Billing\BillingInterface;
use Service\Billing\Transfer\Card;
use Service\Communication\CommunicationInterface;
use Service\Communication\Sender\Email;
use Service\Discount\DiscountInterface;
use Service\Discount\NullObject;
use Service\Order\Basket;
use Service\User\Security;
use Service\User\SecurityInterface;

class Checkout
{
    private $billing;
    private $discount;
    private $communication;
    private $security;

    public function __construct(Card $billing, NullObject $discount, Email $communication, Security $security)
    {
        $this->billing = $billing;
        $this->discount = $discount;
        $this->communication = $communication;
        $this->security = $security;
    }

    public function checkout(): void
    {
        $billing = $this->billing;
        $discount = $this->discount;
        $communication = $this->communication;
        $security = $this->security;
        $this->checkoutProcess($discount, $billing, $security, $communication);
    }

    public function checkoutProcess(
        DiscountInterface $discount,
        BillingInterface $billing,
        SecurityInterface $security,
        CommunicationInterface $communication
    ): void {
        $totalPrice = 0;
        foreach ($this->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $billing->pay($totalPrice);

        $user = $security->getUser();
        $communication->process($user, 'checkout_template');
    }

}