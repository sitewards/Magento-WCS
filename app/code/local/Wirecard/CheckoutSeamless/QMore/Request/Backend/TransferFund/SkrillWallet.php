<?php
/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig.
*
* Software & Service Copyright (C) by
* Wirecard Central Eastern Europe GmbH,
* FB-Nr: FN 195599 x, http://www.wirecard.at
*/

/**
 * @name WirecardCEE_QMore_Request_Backend_TransferFund_SkrillWallet
 * @category WirecardCEE
 * @package  WirecardCEE_QMore
 * @version 3.1.0
 */
class WirecardCEE_QMore_Request_Backend_TransferFund_SkrillWallet extends WirecardCEE_QMore_Request_Backend_TransferFund
{

    public function send($amount, $currency, $orderDescription, $customerStatement, $consumerEmail)
    {
        $this->_setField(self::AMOUNT, $amount);
        $this->_setField(self::CURRENCY, $currency);
        $this->_setField(self::ORDER_DESCRIPTION, $orderDescription);
        $this->_setField(self::CUSTOMER_STATEMENT, $customerStatement);
        $this->_setField(self::CONSUMEREMAIL, $consumerEmail);

        $orderArray = Array(
            self::CUSTOMER_ID,
            self::SHOP_ID,
            self::PASSWORD,
            self::SECRET,
            self::LANGUAGE
        );
        if ($this->_getField(self::ORDER_NUMBER) !== null)
        {
            $orderArray[] = self::ORDER_NUMBER;
        }

        if ($this->_getField(self::CREDIT_NUMBER) !== null)
        {
            $orderArray[] = self::CREDIT_NUMBER;
        }

        $orderArray[] = self::ORDER_DESCRIPTION;
        $orderArray[] = self::AMOUNT;
        $orderArray[] = self::CURRENCY;

        if ($this->_getField(self::ORDER_REFERENCE) !== null)
        {
            $orderArray[] = self::ORDER_REFERENCE;
        }

        if ($this->_getField(self::CUSTOMER_STATEMENT) !== null)
        {
            $orderArray[] = self::CUSTOMER_STATEMENT;
        }

        $orderArray[] = self::FUNDTRANSFERTYPE;
        $orderArray[] = self::CONSUMEREMAIL;

        $this->_fingerprintOrder->setOrder($this->_fingerprintOrder->setOrder($orderArray));

        return new WirecardCEE_QMore_Response_Backend_TransferFund($this->_send());
    }
}