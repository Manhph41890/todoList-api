<?php

use Carbon\Carbon;
use Dingo\Api\Routing\Router;
use Illuminate\Contracts\Foundation\Application;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'DevWork');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance
     *
     * @return Carbon
     */
    function carbon()
    {
        return new Carbon();
    }
}

if (! function_exists('option')) {
    /**
     * Create a new OptionUtility instance
     *
     * @return \App\Utils\OptionUtility
     */
    function option()
    {
        return app('option');
    }
}

if (! function_exists('responder')) {
    /**
     * Get custom response utility
     *
     * @return \App\Utils\ResponseUtility
     */
    function responder()
    {
        return app('responder');
    }
}

if (! function_exists('apiRoute')) {
    /**
     * @return Router|Application|mixed
     */
    function apiRoute()
    {
        return app(Dingo\Api\Routing\Router::class);
    }
}

if (! function_exists('hasIncludeRequest')) {
    /**
     * Check include query param has key
     *
     * @param $key
     * @return bool|false
     */
    function hasIncludeRequest($key)
    {
        return in_array($key, explode(',', request()->get('include')), true);
    }
}

if (! function_exists('getIncludeRequest')) {
    /**
     * Get combine include request
     *
     * @param array $defaultInclude
     * @return array
     */
    function getIncludeRequest(array $defaultInclude = []): array
    {
        $queryIncludeParams = request()->has('include') ? explode(',', request()->get('include')) : [];
        return array_unique(array_merge($queryIncludeParams, $defaultInclude));
    }
}

if (! function_exists('getWebURL')) {
    /**
     * Build web url with query params
     *
     * @param string $segment
     * @param array $queryParams
     * @return string
     */
    function getWebURL(string $segment, array $queryParams = [])
    {
        $queryString = http_build_query($queryParams);
        return config('const.web_url').$segment.($queryString ? '?'.http_build_query($queryParams) : '');
    }
}


if (! function_exists('throwIf')) {
    /**
     * @param $condition
     * @param $errorConfigKey
     * @throws Throwable
     */
    function throwIf($condition, $errorConfigKey)
    {
        throw_if($condition, new \App\Exceptions\GeneralException(is_array(config("error.$errorConfigKey")) ? config("error.$errorConfigKey") : $errorConfigKey));
    }
}

if (! function_exists('getStoragePath')) {
    /**
     * @param $path
     * @return string
     */
    function getStoragePath($path): string
    {
        $parseRequestPath = optional(parse_url($path));
        $parseStorageURL = optional(parse_url(Storage::url('/')));
        $path = ($parseStorageURL['host'] === $parseRequestPath['host']) ? $parseRequestPath['path'] : $path;

        return trim($path, '/');
    }
}

if (! function_exists('getStorageURL')) {
    /**
     * @param $path
     * @return string
     */
    function getStorageURL($path): string
    {
        $parsePath = optional(parse_url($path));
        if ($parsePath['host']) {
            return $path;
        }

        return Storage::url($path);
    }
}

if (! function_exists('checkAdmin')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function checkAdmin($type)
    {
        $arrType = [
            'admin',
            'hradmin',
            'sale',
        ];
        if (in_array($type, $arrType)) {
            return true;
        }
        return false;
    }
}

