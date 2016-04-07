<?

if(isset($_GET['code'])){
	$code = $_GET['code'];
	$parameters = [
		'code' => $code,
		'client_id' => 'CLIENT_ID',
		'client_secret' => 'CLIENT_SECRET',
		'redirect_uri' => 'https://url.to/scottbot.php'
	];
	$url = 'https://slack.com/api/oauth.access?'.http_build_query($parameters);
	$response = @file_get_contents($url);
	$success = false;
	$message = '';
	if($response){
		$r = json_decode($response, true);
		if($r && $r['ok']){
			$success = true;
		}else{
			$message = $r['error'];
		}
	}
	if($success){
		echo '<h1>Success!</h1>';
	}else{
		echo "<h1>Fail! - {$message}</h1>";
	}
	header("HTTP/1.1 200 OK");
	exit();
}

$tokens = [
	'SLASH',
	'COMMAND',
	'TOKEN[S]'
];

$gifs = [
	'http://33.media.tumblr.com/eb09e03e6e17e8312bfe85c413733a57/tumblr_n3fimjrU4o1st03tqo1_400.gif',
	'http://cdn1.theodysseyonline.com/files/2015/01/08/635562833871498009-1021898447_TWSS.jpg',
	'http://i.imgur.com/cspFdSg.gif',
	'http://i.imgur.com/0tfyZnk.gif',
	'https://s-media-cache-ak0.pinimg.com/736x/cf/c6/c0/cfc6c0b47d2498e1919bd8b00c325453.jpg',
	'http://cdn.head-fi.org/a/aa/aa38095b_Michael-Scott-The-Office-Thats-What-She-Said-Meme.jpeg',
	'http://cdn.meme.am/instances/250x250/23260590.jpg',
	'http://i.giphy.com/3v3UJcRl0NhUk.gif',
	'http://i.giphy.com/8wkXMxbONnEFq.gif',
	'http://i.giphy.com/JwbRf8zJuJKUw.gif',
	
];

$quotes = [
	'I am downloading some N3P music.',
	'I am dead inside.',
	'WHERE ARE THE TURTLES?!',
	'The worst thing about prison was -- was the Dementors',
	'Welcome back, jerky jerk face',
	'Sometimes I\'ll start a sentence and I don\'t even know where it\'s going. I just hope I find it along the way.',
	'Occasionally, I\'ll hit somebody with my car. So sue me.',
	'If I had a gun with two bullets, and I was in a room with Hitler, Bin Laden, and Toby, I would shoot Toby twice.',
	'Should have burned this place down when I had the chance.',
	'Well, just tell him to call me as ASAP as possible.',
	'You know what they say. "Fool me once, strike one, but fool me twice... Strike three."',
	'Well, happy birthday, Jesus. Sorry your party\'s so lame.',
	'Do you think that doing alcohol is cool?',
	'Make friends first, make sales second, make love third. In no particular order.',
	'Would I rather be feared or loved? Easy, both. I want people to be afraid of how much they love me.',
	'It\'s simply beyond words. It\'s incalcucable.',
	'Abraham Lincoln once said that "If you\'re a racist, I will attack you with the North" and these are the principles I carry with me in the workplace.',
	'I guess the atmosphere that I\'ve tried to create here is that I\'m a friend first and a boss second, and probably an entertainer third.',
	'I think if I was allergic to dairy I\'d kill myself.',
	'Wow, all these charts and graphs. Someone\'s been doing their homework... looks like USA Today.',
	'Captain Jack\'s a fart face.',
	'Is this done? Extreme Home Makeover puts together a house in an hour. If you were on that crew you would be fired like that!',
	'Yeah I am fussy! Aspirins not gonna do a damn thing! Im sitting here with a bloody stump of a foot.',
	'Yankee Swap is like Machiavelli meets Christmas',
	'I know a ton of 14-year old girls that could kick his ass.',
	'I\'m an early bird and a night owl. So Im wise and I have worms.'
];
if(isset($_POST['token'])){
	if(in_array($_POST['token'], $tokens)){
		$command = isset($_POST['command']) ? $_POST['command'] : false;
		$response = '';

		if($command){
			switch($command){
				case '/twss':
					$response = $gifs[array_rand($gifs)];
					break;
				case '/mscott':
					$response = $quotes[array_rand($quotes)];
					break;
			}
			if($response){
				header('Content-Type: application/json');
				echo json_encode([
					'text' => $response,
					'response_type' => 'in_channel'
				]);
			}
		}
	}
}
header("HTTP/1.1 200 OK");

exit();
