<?php
namespace Trasigor\Messari;

use Illuminate\Support\Facades\Facade;

/**
 * Class MessariFacade
 * @method static \Trasigor\Messari\Api get(string $method, array $params = [])
 * @method static \Trasigor\Messari\Api getAllMarkets(array $params = [])
 * @method static \Trasigor\Messari\Api getAllAssets(array $params = [])
 * @method static \Trasigor\Messari\Api getProfileBySymbol(string $symbol, array $params = [])
 * @method static \Trasigor\Messari\Api getMetricsBySymbol(string $symbol, array $params = [])
 * @method static \Trasigor\Messari\Api getNews(array $params = [])
 * @method static \Trasigor\Messari\Api getNewsBySymbol(string $symbol, array $params = [])
 * @package Trasigor\Messari
 */
class MessariFacade extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Trasigor\Messari\Api';
    }
}
