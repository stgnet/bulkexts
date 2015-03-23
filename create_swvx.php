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
		$entry['password']=$faker->numerify('########');
		$entry['phone_password']=substr(md5($entry['fname'].$entry['lname']),0,16);

		echo $extension.': '.$entry['email']."\n";

		fputcsv($fp,$entry);
	}
