<?php


namespace Model\Repository;

use Service\Billing\Exception\BillingException;
use Service\Billing\Transfer\Card;
use Service\Builder\BasketBuilder;
use Service\Communication\Exception\CommunicationException;
use Service\Communication\Sender\Email;
use Service\Discount\NullObject;
use Service\Order\Basket;
use Service\User\Security;
use Service\Order\CheckoutProcess;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CheckoutFacade
{
    private $discount;
    private $billing;
    private $security;
    private $communication;


    public function __construct(BasketBuilder $builder, NullObject $discount, Card $billing, Security $security, Email $communication)
    {
        $this->discount = $builder->setDiscount($discount);
        $this->billing = $builder->setBilling($billing);
        $this->security = $builder->setSecurity($security);
        $this->communication = $builder->setCommunication($communication);

    }

    public function checkout($discount, $billing, $security, $communication): void
    {
        $checkoutProcess = new CheckoutProcess($discount, $billing, $security, $communication);
        $this->$checkoutProcess->handler();
    }
}