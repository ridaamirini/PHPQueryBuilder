<?php
/**
 * Created by Rida Amirini.
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 15:00
 */

namespace App\Utils;


class Version
{
    public function getVersion()
    {
        $rev = exec('git rev-parse --short HEAD');
        $version = json_decode(@file_get_contents(__DIR__ . '../../../../version.json'), true);

        return $version['version'] . ' build ' . $rev;
    }
}