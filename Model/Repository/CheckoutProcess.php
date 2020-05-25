<?php


namespace Model\Repository;


use Service\Builder\BasketBuilder;
use Service\Order\Basket;

class CheckoutProcess
{
    private $discount;
    private $billing;
    private $security;
    private $communication;

    /**
     * Проведение всех этапов заказа
     * @param CheckoutFacade $discount
     * @param CheckoutFacade $billing
     * @param CheckoutFacade $security
     * @param CheckoutFacade $communication
     */

    public function __construct(CheckoutFacade $discount, CheckoutFacade $billing, CheckoutFacade $security, CheckoutFacade $communication)
    {
        $this->discount = $discount;
        $this->billing = $billing;
        $this->security = $security;
        $this->communication = $communication;
    }

    public function handler(): void {
        $basket = new Basket;
        $totalPrice = 0;
        foreach ($basket->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $this->billing->pay($totalPrice);

        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');
    }

}