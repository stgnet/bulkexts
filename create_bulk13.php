<?php
	/* Changed to support FreePBX 13 "Bulk Handler" */

	require_once 'Faker/src/autoload.php';

	$faker = Faker\Factory::create('en_US');

	$fp=fopen("bulk13-default.csv","r");

	$header=fgetcsv($fp);

	$data=fgetcsv($fp);
	fclose($fp);

	foreach ($header as $index => $key)
		$default[$key]=$data[$index];

	$fp=fopen("bulk13ext.csv","w");
	fputcsv($fp,$header);
	fputcsv($fp,$default);

	$count=500;
	$extension = $default['extension'];

	while ($count--)
	{
		$entry=$default;
		$entry['extension']=++$extension;
		$entry['name']=$faker->firstName.' '.$faker->lastName;
		$entry['description']='Sample Extension '.$extension;
		$entry['tech'] = 'pjsip';
		$entry['dial'] = 'PJSIP/'.$extension;
		$entry['secret']=md5($entry['name']);

		echo $extension.': '.$entry['name']."\n";

		fputcsv($fp,$entry);
	}
