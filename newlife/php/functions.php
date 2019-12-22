<?php

function debug($variable){ //for debug

	echo '<pre>' . print_r($variable, true) . '</pre>';

}

function str_random($length){//to create random token

	$alphabet = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

	return substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);
}

function logged_only(){ //for log

		if(session_status() == PHP_SESSION_NONE){

			session_start();

		}

		if(!isset($_SESSION['auth'])){

		$_SESSION['flash']['danger'] = "Pour communiquer avec des professionnels,inscrivez vous sur HelpWork des maintenant.";

		header('Location :index.php');

		exit();
	}
}
function register($username,$userprenom ,$password ,$email,$status){ //for insert data in the datebase
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));

		$req = $pdo ->prepare ("INSERT INTO members SET username = ?,userFname = ?, password = ?, email = ? , confirmation_token = ?,status = ?");

		$password = password_hash($password,PASSWORD_BCRYPT);

		$token = str_random(40);

		$req->execute([$username,$userprenom ,$password ,$email, $token,$status]);

		$user_id = $pdo->lastInsertId();

		$header="MIME-Version: 1.0\r\n";
        $header.='From:"tribalup.com"<support@Tribalup.com>'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
		if($status==0){
        	mail($email, "Registration confirmation - Tribalup.com", "To validate your account, please click on this link \n\nhttp://localhost/newlife/confirm.php?id=$user_id&token=$token",$header);
		}else{
			mail($email, "Registration confirmation - Tribalup.com", "To validate your account, please click on this link \n\nhttp://localhost/newlife/confirm2.php?id=$user_id&token=$token",$header);
		}
        $_SESSION['flash']['sucess'] = "A confirmation email has been sent to you to validate your account";

        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['userprenom'] = $userprenom;
        $_SESSION['statut'] = $status;
        $_SESSION['token'] = $token ;
        $_SESSION['id'] = $user_id ;


}

function addPic($id,$name){//for add picture
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
			$inserImg=$pdo->prepare('INSERT INTO avatar_members(id_members,avatar,date_upload) VALUES (?,?,now())');
            $inserImg->execute(array($id,$name));
            $message = "Upload réussi ! Votre avatar s'affichera apres verification";
	

}

function updatePic($name,$id){//for update picture
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
	 		$confirm1 = $pdo->prepare('UPDATE avatar_members SET avatar=? WHERE id_members = ?');
            $confirm1->execute([$name,$id]);
            $message = "Upload réussi ! Votre avatar est mis a jour!";

}
function addBack($id,$name){//for add background
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
	$inserImg=$pdo->prepare('INSERT INTO background_members(id_members,background,date_background) VALUES (?,?,now())');
              $inserImg->execute(array($id,$name));
              $message = "Upload réussi ! Votre fond s'affichera apres verification";

}

function updateBack($name,$id){//for update background
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
	 $confirm = $pdo->prepare('UPDATE background_members SET background=? WHERE id_members = ?');

              $confirm->execute([$name,$id]);
              $message = "Upload réussi ! Votre fond est mis a jour!";

}

function addComment($id,$id2,$comment){//to add comment
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
	$post=$pdo->prepare('INSERT INTO comments(id_members,comments,date_comments) VALUES(?,?,now())');
	$post->execute(array($id,$comment));

		//$pdo->exec("UPDATE comments SET mess_post=mess_post+1 WHERE id_members='".$_SESSION['id']."'");
    $lastid = $pdo->query('SELECT last_insert_id() FROM comments');
    $salut=$lastid->fetch();



    $req=$pdo->prepare('INSERT INTO comments_profil(id_comments,on_profil_id,from_profil_id) VALUES(?,?,?)');
    $req->execute(array($salut[0],$id,$id2));

}

function addInfo($id,$punch,$future,$story,$level,$fields,$Name_establishment,$profile,$help1,$help2,$help3,$help4,$help5,$age,$city,$defaultCheck1,$defaultCheck2,$defaultCheck3,$defaultCheck4){//to insert date in database
	$pdo = new PDO('mysql:host=localhost;dbname=helpWork;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
$req = $pdo ->prepare ("INSERT INTO info_members_pro SET id_members = ?,punchline = ?, future_job = ?,story=?,level=?,fields=?,establishment=?,profile=?, top1 = ? , top2 = ?,top3 = ?,top4 = ?,top5 = ?,age = ?,city = ?,way=?, way2=?, way3=?, way4=?");

      $req->execute([$id,$punch,$future,$story,$level,$fields,$Name_establishment,$profile,$help1,$help2,$help3,$help4,$help5,$age,$city,$defaultCheck1,$defaultCheck2,$defaultCheck3,$defaultCheck4]);
}

