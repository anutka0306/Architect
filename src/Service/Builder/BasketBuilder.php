<?php


namespace Service\Builder;
use Service\Billing\Transfer\Card;
use Service\Discount\NullObject;
use Service\Communication\Sender\Email;
use Service\Order\Basket;
use Service\User\Security;
use Service\Discount\DiscountInterface;


class BasketBuilder
{

    private $billing;
    private $discount;
    private $communication;
    private $security;

    public function getBilling(): ?Card{
        return $this->billing;
    }

    public function getDiscount(): ?NullObject{
        return $this->discount;
    }

    public function getCommunication(): ?Email{
        return $this->communication;
    }

    public function getSecurity(): ?Security{
        return $this->security;
    }

    public function setBilling(Card $card){
        $this->billing = $card;
        return $this;
    }

    public function setDiscount(NullObject $nullObject){
        $this->discount = $nullObject;
        return $this;
    }

    public function setCommunication(Email $email){
        $this->communication = $email;
        return $this;
    }

    public function setSecurity(Security $security){
        $this->security  = $security;
        return $this;
    }
    public function build(): Basket
    {
        return new Basket($this);
    }
}