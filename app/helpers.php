<?php

function formatRupiah($data)
{
    $rupiah = 'Rp. ' . number_format($data, 0, ",", ".");

    return $rupiah;
}
