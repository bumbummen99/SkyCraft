<p align="center">
    <img align="center" alt="Beyond the Wire RCON PHP Logo" src="https://raw.githubusercontent.com/bumbummen99/SkyCraft/master/screenshot.png">
</p>
<div align="center">
    <h1 align="center">SkyCraft WordPress-Theme</h1>
    <p align="center">
        <b>A WordPres-Theme for Minecraft servers & communities</b>
    </p>
</div>

## Installation
Simply download the latest release skycraft.zip from the Releases page or click [here](https://github.com/bumbummen99/SkyCraft/releases/latest). Upload the theme file to your WordPress installtion. DO NOT UNZIP THE FILE.

[Read more here on the official WordPress Documentation](https://wordpress.org/support/article/using-themes/#adding-new-themes-manually-ftp)

## Update
The Theme does integrate the wp-update-server to provide theme updates. These should work automatically, if you encounter any issues with the update server please let me know via mail or by creating an issue on this repository.

## Performance

Using this theme your server will be queried every minute at max but due to how WordPress handles scheduled tasks it will run on a request to your site, slowing that request down leading to a very long page load time. To mitigate that issue you will want to use a [real Cronjob for WordPress](https://docs.wpwebelite.com/replace-wordPress-cron-with-a-real-cron-job/) where your hosting situation does allow it. Using a real Cronjob your Site will run scheduled Tasks in the Background. **Make sure to configure a short interval, at best 1 minute**.

## Custom Textures
This theme does support the use of any texture pack. Simply replace the textures in the img/ folder with your version. You might have to adjust the left/right images to fit.
