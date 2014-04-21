#WP Foo Plugin
A Wordpress Plugin that is mainly used for testing

You can use this plugin to test **Automatic Updates For Private And Commercial Plugins**. 

See below details and instructions on how to use and configure this to work in your plugins.

For plugins stored on Github repositories, the below configs are used. 

##### Metadata
Can be stored within the plugin folder e.g. ``wp-foo-plugin/metadata.json`` so when it is committed to the repo it will be publicly available via the url using the raw file e.g. ``https://raw.githubusercontent.com/ramalveyra/wp-foo-plugin/master/metadata.json``. This can also be placed on a separate repository ie. a separate repository that would just contain the metadata for every plugin you own as long as it is publicly available.

Change this each time there is an update to the plugin.

Supply the details that you want to show within the update on this file.
```
{
    "name" : "WP Foo Plugin",
    "slug" : "wp-foo-plugin",
    "homepage" : "https://github.com/Link7",
    "download_url" : "https://github.com/ramalveyra/wp-foo-plugin/archive/v0.1.zip",
    
    "version" : "0.1",
    "requires" : "0.1",
    "tested" : "0.1",
    "last_updated" : "2012-04-21 09:00:00",
    "upgrade_notice" : "List here why you should upgrade...",
    
    "author" : "Link7",
    "author_homepage" : "https://github.com/Link7",
    
    "sections" : {
        "description" : "(Required) Plugin description. Basic HTML can be used in all sections.",
        "installation" : "(Recommended) Installation instructions.",
        "changelog" : "(Recommended) Changelog. <p>This section will be opened by default when the user clicks 'View version XYZ information'.</p>",
        "custom_section" : "This is a custom section labeled 'Custom Section'." 
    }
}
```
NOTE: For this to work on plugins stored in Github, the ``download_url`` has been supplied with the plugin's "download zip" link: ``https://github.com/ramalveyra/wp-foo-plugin/archive/v0.1.zip``.


##### Auto updater client libraries and configs
A copy of the client library: http://1.shadowcdn.com/files/plugin-updates-1.4.zip must be placed within your plugin directory.

On top of the main plugin file, supply the necessary auto updater plugin call
```
require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'https://raw.githubusercontent.com/ramalveyra/wp-foo-plugin/master/metadata.json',
    __FILE__,
    'wp-foo-plugin'
);

```
NOTE: One of the params supplied is the link to the raw version of the metadata file.

When all of the items above have been configured properly, there should be a link saying "Check for Updates" on the plugin when viewed on the admin plugin list. It should also display a badge whenever there is an update available (whenever there is a change in the metadata json file). The default cron check (wordpress) is every 12 hours and can be configured as well.

See http://w-shadow.com/blog/2010/09/02/automatic-updates-for-any-plugin/ for more details on the auto updater plugin configs.

A **big note**, use a separate plugin copy and NOT the actual cloned (git) repo once you have added the auto updater. The idea of auto update is that there would be no need to do a "git pull" to update your plugins.It will instead use the default way Wordpress allows updates to the plugins which is via the UI. If you use a git cloned repo of your plugin and apply the update via the UI, it will overwrite the plugin folder and the git repository will be replaced, your branches and git references etc. will be lost.


Credits:
Yahnis Elsts http://w-shadow.com/