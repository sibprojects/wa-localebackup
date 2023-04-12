<?php

class shopLocalebackupPlugin extends shopPlugin
{
	public static function getApps()
	{
		return ['blog','mailer','mylang','shop','site'];
	}

	public static function getLocales()
	{
		return ['en_US','ru_RU','uk_UA'];
	}

}
