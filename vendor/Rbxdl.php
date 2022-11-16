<?php

$extensions = define("extensions", [
    0 => "",
    1 => "png",
    2 => "xml",
    3 => "xml",
    4 => "",
    5 => "",
    8 => "xml",
    9 => "rbxl",
    10 => "rbxm",
    11 => "xml",
    12 => "xml",
    13 => "xml",
    17 => "xml",
    18 => "xml",
    19 => "xml"
], false);

$extensions = extensions;
$api = "https://assetdelivery.roblox.com/v1/asset?id=";
$market_api = "https://api.roblox.com/marketplace/productinfo?assetId=";

class Rbxdl {
    function __construct($save_location) {
        if (!is_dir($_SERVER["DOCUMENT_ROOT"] . $save_location)) {
            throw new Exception("Invalid save location: " . $_SERVER["DOCUMENT_ROOT"] . $save_location);
        }

        $this->store = $save_location;

        return $this;
    }

    public function doesAssetExist($assetId) {
        global $market_api;
        $url = $market_api . $assetId;
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($handle);
        $response_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        if ($response_code != 200) {
            return false;
        }
        return true;
    }

    public function getAssetData($assetId) {
        global $market_api;
        if ($this->doesAssetExist($assetId)) {
            $get = file_get_contents($market_api . $assetId);
            return $get;
        }
    }

    public function downloadAsset($assetId, $storeName) {
        global $api;
        global $extensions;
        if ($this->doesAssetExist($assetId)) {
            $assetType = json_decode($this->getAssetData($assetId))->AssetTypeId;
            if (array_key_exists($assetType, $extensions)) {
                if (file_put_contents($_SERVER["DOCUMENT_ROOT"] . $this->store . "\\" . $storeName . "." . $extensions[$assetType], file_get_contents($api . $assetId))) {
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }
}
