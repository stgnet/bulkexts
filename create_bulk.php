<?php
	require_once 'Faker/src/autoload.php';

	$faker = Faker\Factory::create('en_US');

	$fp=fopen("bulkext-default.csv","r");

	$header=fgetcsv($fp);

	$data=fgetcsv($fp);
	fclose($fp);

	foreach ($header as $index => $key)
		$default[$key]=$data[$index];

	$default['action']='add';

	$fp=fopen("bulkext.csv","w");
	fputcsv($fp,$header);
	fputcsv($fp,$default);

	$count=500;
	$extension = $default['extension'];

	while ($count--)
	{
		$entry=$default;
		$entry['extension']=++$extension;
		$entry['cid_masquerade']=$extension;
		$entry['outboundcid']=2565120000+$extension;
		$entry['name']=$faker->firstName.' '.$faker->lastName;
		$entry['devinfo_secret']=md5($entry['name']);
		$entry['devinfo_dial']='SIP/'.$extension;
		$entry['devinfo_mailbox']=$extension.'@device';
		$entry['deviceuser']=$extension;
		$entry['description']=$entry['name'];
		$entry['vm']='enabled';
		$entry['vmpwd']=$extension;

		echo $extension.': '.$entry['name']."\n";

		fputcsv($fp,$entry);
	}
