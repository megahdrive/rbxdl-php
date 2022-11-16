# rbxdl-php
Rbxdl-php is a server-side asset downloader for Roblox, written in PHP.
I really liked [Modnark's ROBLOX asset downloader](https://github.com/Modnark/rbxdl) so I decided to make my own that can run natively along with my other PHP code.
## Help
Right now, Rbxdl-php can't parse all file formats and so some assets might throw an error or not save. As a temporary hotfix, you can add the AssetTypeId of the item to the extensions definition with its file format.  
Eventually I will implement them all, but I'm lazy, so you'll have to wait. If you want to do it yourself, open a pull request and I'll probably accept it.
## Examples
```php
$rbxdl = new Rbxdl("/xml");
// getAssetData does this automatically, but won't give you a boolean. This does.
$doesHatExist = $rbxdl->doesAssetExist(21681881);
$data = $rbxdl->getAssetData(21681881);
// Returns true if success. downloadAsset automatically saves as XML.
$download = $rbxdl->downloadAsset(21681881, "hat");
```
