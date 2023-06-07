<?php

class shopLocalebackupPluginBackendRestoreController extends waController
{
    public function execute()
    {
        $path = wa()->getDataPath('localebackup/', false, 'shop');

        $apps    = shopLocalebackupPlugin::getApps();
        $locales = shopLocalebackupPlugin::getLocales();

        foreach ($apps as $app) {
            $appPath = wa()->getAppPath(null, $app);
            foreach ($locales as $locale) {
                if (!file_exists($appPath.'/locale/'.$locale)) {
                    mkdir($appPath.'/locale/'.$locale);
                }

                if (!file_exists($appPath.'/locale/'.$locale.'/LC_MESSAGES')) {
                    mkdir($appPath.'/locale/'.$locale.'/LC_MESSAGES');
                }

                if (file_exists($path.$app.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.po')) {
                    @unlink($appPath.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.po');
                    @copy($path.$app.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.po', $appPath.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.po');
                }

                if (file_exists($path.$app.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.mo')) {
                    @unlink($appPath.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.mo');
                    @copy($path.$app.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.mo', $appPath.'/locale/'.$locale.'/LC_MESSAGES/'.$app.'.mo');
                }
            }
        }

        die('Restored');
    }

}
