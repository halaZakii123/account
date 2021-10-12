<?php

 namespace App\Helpers;



    class currencyHelper
    {
        /**
     * @param $money
     * @return string
     */
        function format_money_pdf($money, $currency = null)
        {
            $money = $money / 100;

            if (! $currency) {
                $currency = Currency::findOrFail(CompanySetting::getSetting('currency', 1));
            }

            $format_money = number_format(
                $money,
                $currency->precision,
                $currency->decimal_separator,
                $currency->thousand_separator
            );

            $currency_with_symbol = '';
        if ($currency->swap_currency_symbol) {
            $currency_with_symbol = $format_money.'<span style="font-family: DejaVu Sans;">'.$currency->symbol.'</span>';
        } else {
            $currency_with_symbol = '<span style="font-family: DejaVu Sans;">'.$currency->symbol.'</span>'.$format_money;
        }

        return $currency_with_symbol;
    }
}
