<?php
	require_once 'Faker/src/autoload.php';

	use stgnet\pdb;
	require 'pdb/pdb.php';

	$mydb=array(
		'pdo'=>'mysql',
		'host'=>'localhost',
		'dbname'=>'asterisk',
		'charset'=>'utf8',
		'username'=>'root',
		'password'=>'passw0rd'
	);

	$pdb = pdb::connect($mydb);

	$users_schema=array(
		pdb::Field_String('email',128)->PrimaryKey()->NotNull(),
		pdb::Field_String('name',128)->NotNull(),
		pdb::Field_String('pin',16),
		pdb::Field_Decimal('balance',10,2)
	);

	$ps_endpoints=pdb::connect($pdb, 'ps_endpoints');
	$ps_aors=pdb::connect($pdb, 'ps_aors');
	$ps_auths=pdb::connect($pdb, 'ps_auths');


	$faker = Faker\Factory::create('en_US');


	$count=500;
	$extension = 200;

	while ($count--)
	{
		$where = array('id' => $extension);

		$aor=array();
		$aor['id'] = $extension;
		$aor['mailboxes'] = $extension;

		try {
			$ps_aors->insert($aor);
		} catch (Exception $e) {
			$ps_aors->update($where, $aor);
		}

		$endpoint = array();
		$endpoint['id'] = $extension;
		$endpoint['aors'] = $extension;
		$endpoint['auth'] = $extension;
		$endpoint['force_rport'] = 'yes';
		$endpoint['mailboxes'] = $extension;
		$endpoint['callerid']=$faker->firstName.' '.$faker->lastName;

		try {
			$ps_endpoints->insert($endpoint);
		} catch (Exception $e) {
			$ps_endpoints->update($where, $endpoint);
		}

		$auth = array();
		$auth['id'] = $extension;
		$auth['password'] = '12341234';
		$auth['username'] = $extension;

		try {
			$ps_auths->insert($auth);
		} catch (Exception $e) {
			$ps_auths->update($where, $auth);
		}

		echo $extension.': '.$endpoint['callerid']."\n";

		$extension++;
	}
