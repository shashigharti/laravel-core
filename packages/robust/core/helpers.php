<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('is_active')) {
    /**
     * @param $url
     * @return string
     */
    function is_active($url)
    {
        return ($url === Request::url()) ? 'active' : '';
    }
}
if (!function_exists('is_edit_mode')) {
    /**
     * @param $model
     * @return bool
     */
    function is_edit_mode($model)
    {
        return ($model->exists) ? true : false;
    }
}


if (!function_exists('is_add_mode')) {
    /**
     * @param $model
     * @return bool
     */
    function is_add_mode($model)
    {
        return ($model->exists) ? false : true;
    }
}

if (!function_exists('settings')) {
    /**
     * @return string
     */
    function settings($slug, $name = null)
    {
        $setting = \Robust\Core\Models\Setting::where('slug', $slug)->first();
        if (isset($setting->values)) {
            $values = json_decode($setting->values, true);
        }

        if ($name == null) {
            return isset($values) ? $values : "";
        }

        return isset($values[$name]) ? $values[$name] : '';
    }
}

if (!function_exists('getMedia')) {
    /**
     * @return string
     */
    function getMedia($media_id)
    {
        $media = (new \Robust\Core\Models\Media)->find($media_id);
        if($media)
            return asset('/medias/' . $media->id . '/' . $media->file);

        return null;
    }
}
if (!function_exists('emails')) {
    /**
     * @return string
     */
    function emails($event)
    {
        if ($event) {
            $event_model = (new \Robust\Core\Models\EmailSetting())->where('event', $event)->first();
            if ($event_model) {
                $emails = explode(', ', $event_model->email);
                return $emails;
            }
        }
        return null;
    }
}
if (!function_exists('seo')) {
    /**
     * @return eloquent
     */
    function seo($segments)
    {
        $page = null;
        $additional_route_params =  [
            'price' => 'price',
        ];
        $segments_temp = $segments;

        for($i = count($segments_temp) - 1; $i >= 0; $i--){
            $partial_url_str = implode("/", $segments_temp );
            $page = (new \Robust\RealEstate\Models\Page)->where('url', $partial_url_str)->first();
            if($page){
                break;
            }
            unset($segments_temp[$i]);
        }

        if(!$page){
            foreach ($additional_route_params as $param) {
                if (in_array($param, $segments)) {
                    $partial_url_str = $param;
                    print_r($partial_url_str);
                    $page = (new \Robust\RealEstate\Models\Page)->where('url', $partial_url_str)->first();
                    break;
                }
            }
        }
        return ( $page == null ) ? [] : $page;
    }
}
