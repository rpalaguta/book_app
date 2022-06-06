<?php

namespace App\Services;

use App\Exceptions\PriceFormatterException;
use http\Exception;
use Illuminate\Support\Facades\Log;

class PriceFormatter
{
    public function format(float $price)
    {
        //$this->checkPrice($price);

        try {
            $this->checkPrice($price);
        } catch (PriceFormatterException $exception) {
            Log::channel('slack')->warning($exception);
            //throw new PriceFormatterException($exception->getMessage());
            //return null;
        } catch (\Exception $exception) {
            throw new \Exception($exception);
        }

        return $price;
    }

    public function checkPrice(float $price)
    {
        if ($price > 5) {
            //Log::notice('Bad price: single');
            //Log::channel('slack')->warning('Bad price: slack', ['price' => $price]);
            //Log::stack(['single', 'slack'])->info('Bad price: slack', ['price' => $price]);
            //throw new PriceFormatterException('Price is higher');
            throw new \Exception('bad');
        }

        return $price;
    }
}
