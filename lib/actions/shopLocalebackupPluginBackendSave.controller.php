<?php

class shopLocalebackupPluginBackendSaveController extends waController
{
    public function execute()
    {
        $path = wa()->getDataPath('localebackup/', false, 'shop');

        $apps = shopLocalebackupPlugin::getApps();
        $locales = shopLocalebackupPlugin::getLocales();

        foreach ($apps as $app) {
            if (!file_exists($path . $app)) {
                mkdir($path . $app);
                mkdir($path . $app . '/locale');
                foreach ($locales as $locale) {
                    mkdir($path . $app . '/locale/' . $locale);
                    mkdir($path . $app . '/locale/' . $locale . '/LC_MESSAGES');
                }
            }

            $appPath = wa()->getAppPath(null, $app);
            foreach ($locales as $locale) {
                @unlink($path . $app . '/locale/' . $locale . '/LC_MESSAGES/' . $app . '.po');
                @unlink($path . $app . '/locale/' . $locale . '/LC_MESSAGES/' . $app . '.mo');
                @copy($appPath . '/locale/' . $locale . '/LC_MESSAGES/' . $app . '.po', $path . $app . '/locale/' . $locale . '/LC_MESSAGES/' . $app . '.po');
                @copy($appPath . '/locale/' . $locale . '/LC_MESSAGES/' . $app . '.mo', $path . $app . '/locale/' . $locale . '/LC_MESSAGES/' . $app . '.mo');
            }
        }

        die('Saved!');
    }
}
