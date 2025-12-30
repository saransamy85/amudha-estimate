<?php

use App\Models\estimate;

if (!function_exists('generateEstimateNumber')) {
    function generateEstimateNumber()
    {
        // Financial year logic
        $currentYear = date('Y');
        $currentMonth = date('m');

        if ($currentMonth >= 4) {
            $fyStart = $currentYear;
            $fyEnd = $currentYear + 1;
        } else {
            $fyStart = $currentYear - 1;
            $fyEnd = $currentYear;
        }

        $financialYear = $fyStart . '-' . substr($fyEnd, -2);

        // Get last estimate number for this FY
        $lastEstimate = estimate::where('estimate_no', 'like', '%/AD/'.$financialYear)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastEstimate) {
            $lastNumber = intval(substr($lastEstimate->estimate_no, 0, 2));
            $nextNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '01';
        }

        return $nextNumber . '/AD/' . $financialYear;
    }
}
