<?php

function truncateText($text, $maxLength, $suffix = '...')
{
    if (mb_strlen($text) > $maxLength) {
        $truncatedText = mb_substr($text, 0, $maxLength - mb_strlen($suffix)) . $suffix;
        return $truncatedText;
    }
    return $text;
}

function generateDate($timestamp) {
    $time = new DateTime($timestamp); // Create a DateTime object from the string
    return $time->format('Y/m/d H:i:s'); // Format the DateTime object
}


function formatRupiah($amount)
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

?>

