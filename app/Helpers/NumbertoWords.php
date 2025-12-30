<?php

if (! function_exists('rupees_in_words')) {

    function rupees_in_words($amount)
    {
        $number = floor($amount);
        $decimal = round($amount - $number, 2) * 100;

        $words = [
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
            5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
            14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen',
            17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen',
            20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
            50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
            80 => 'Eighty', 90 => 'Ninety'
        ];

        $digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
        $string = [];
        $i = 0;

        while ($number > 0) {
            $divider = ($i == 1) ? 10 : 100;
            $chunk = $number % $divider;
            $number = floor($number / $divider);

            if ($chunk) {
                $plural = ($chunk > 9 && $i > 0) ? 's' : '';
                $hundred = ($i == 1 && $string[0]) ? 'and ' : '';

                if ($chunk < 21) {
                    $string[] = $words[$chunk] . ' ' . $digits[$i] . ' ' . $plural . ' ' . $hundred;
                } else {
                    $string[] = $words[floor($chunk / 10) * 10] . ' ' .
                                $words[$chunk % 10] . ' ' .
                                $digits[$i] . ' ' . $plural . ' ' . $hundred;
                }
            } else {
                $string[] = '';
            }

            $i++;
        }

        $result = implode('', array_reverse($string));

        $paise = '';
        if ($decimal > 0) {
            $paise = ' and ' .
                ($decimal < 21 ? $words[$decimal] : $words[floor($decimal / 10) * 10] . ' ' . $words[$decimal % 10]) .
                ' Paise';
        }

        return trim($result) . ' Rupees' . $paise . ' Only';
    }
}
