<?php
	require_once 'Faker/src/autoload.php';

	$faker = Faker\Factory::create('en_US');

	$fp=fopen("swvxext-default.csv","r");

	$header=fgetcsv($fp);

	$data=fgetcsv($fp);
	fclose($fp);

	foreach ($header as $index => $key)
		$default[$key]=$data[$index];

	$fp=fopen("swvxext.csv","w");
	fputcsv($fp,$header);
	fputcsv($fp,$default);

	$count=400;
	$extension = $default['ext'];

	$bademail=array("'");

	while ($count--)
	{
		$entry=$default;
		$entry['ext']=++$extension;
		$entry['fname']=$faker->firstName;
		$entry['lname']=$faker->lastName;
		$entry['email']=str_replace($bademail,"",strtolower($entry['fname'].'.'.$entry['lname'].'@example.org'));
		$entry['password']=$faker->numerify('Ul.#####');
		$entry['phone_password']=$entry['password'];
		$entry['voicemail_password']=$faker->numerify('########');

		echo $extension.': '.$entry['email']."\n";

		fputcsv($fp,$entry);
	}
