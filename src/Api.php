<?php

namespace Trasigor\Messari;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

class Api {

    /**
     * @var string
     */
    protected static $base_url = "https://data.messari.io";

    /**
     * @var string
     */
    protected static $endpoint = "/api/v1";

    /**
     * @param string $method
     * @param array $params
     * @param string $type
     *
     * @return array|boolean
     *
     */
    protected static function _call($method, $params = [], $type = 'GET')
    {
        $url = self::$endpoint.$method;
        $url .= empty($params) ? '' : '?'.http_build_query($params);
        try {
            $http_client = new Client([
                "base_uri" => self::$base_url
            ]);

            $request = $http_client->request($type, $url);

            return json_decode($request->getBody(), true);
        } catch(ClientException $e) {
            return json_decode($e->getResponse()->getBody(), true);
        } catch(ConnectException $e){
            return ['error_code' => $e->getCode(), 'error_message' => $e->getMessage()];
        }
    }

    /**
     * @param string $method API path
     *
     * @param array $params Get params
     *
     * @return array|boolean
     *
     */
    public static function get($method, $params = [])
    {
        return self::_call($method, $params);
    }

    /**
     * Get the list of all exchanges and pairs that Messari WebSocket-based market real-time market data API supports.
     *
     * @param array $params Get params
     *
     * @return array|bool
     */
    public static function getAllMarkets($params = [])
    {
        return self::_call("/markets", $params);
    }

    /**
     * Get the list of all crypto assets that our non-real-time data REST API supports.
     * By default it returns all assets in our system,
     * use query parameters to filter list to those with metrics (quantitative) and profiles (qualitative)
     *
     * @param array $params Get params
     * ________________________
     * param name: with-metrics
     * required: false
     * description: existence of this query param filters assets to those with quantitative data
     * ________________________
     * param name: with-profiles
     * required: false
     * description: existence of this query param filters assets to those with qualitative data
     *
     * @return array|bool
     */
    public static function getAllAssets($params = [])
    {
        return self::_call("/assets", $params);
    }

    /**
     * Get fundamental information by asset symbol.
     *
     * @param string $symbol
     *
     * @param array $params Get params
     *
     * @return array|bool
     */
    public static function getProfileBySymbol($symbol, $params = [])
    {
        return self::_call("/assets/{$symbol}/profile", $params);
    }

    /**
     * Get quantitative metrics by asset symbol.
     *
     * @param string $symbol
     *
     * @param array $params Get params
     *
     * @return array|bool
     */
    public static function getMetricsBySymbol($symbol, $params = [])
    {
        return self::_call("/assets/{$symbol}/metrics", $params);
    }

    /**
     * Get the latest 50 curated articles of news and analysis for all assets.
     *
     * @param array $params Get params
     *
     * @return array|bool
     */
    public static function getNews($params = [])
    {
        return self::_call("/news", $params);
    }

    /**
     * Get the latest 50 curated articles of news and analysis by asset symbol.
     *
     * @param string $symbol
     *
     * @param array $params Get params
     *
     * @return array|bool
     */
    public static function getNewsBySymbol($symbol, $params = [])
    {
        return self::_call("/news/{$symbol}", $params);
    }
}