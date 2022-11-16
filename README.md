# rbxdl-php
A server-side Roblox asset downloader for php  
I really liked [Modnark's ROBLOX asset downloader](https://github.com/Modnark/rbxdl) so I decided to make my own that runs on the web server.  
## Examples
```php
$rbxdl = new Rbxdl("/xml");
// getAssetData does this automatically, but won't give you a boolean. This does.
$doesHatExist = $rbxdl->doesAssetExist(21681881);
$data = $rbxdl->getAssetData(21681881);
// Returns true if success. downloadAsset automatically saves as XML.
$download = $rbxdl->downloadAsset(21681881, "hat");
```
