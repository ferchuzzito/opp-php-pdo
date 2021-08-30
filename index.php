<?php 
require 'classes/Database.php';

$database = new Database;
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($post['delete'])){
	$userID = $post['userID'];;
	$database->query('DELETE FROM usuarios WHERE idusuario = :userID');
	$database->bind(':userID', $userID);
	$database->execute();
}

if(isset($post['Actualizar'])){
     $userID = $post['userID'];
     $username = $post['user'];
     $nameuser = $post['nameuser'];
     $passwd = $post['passwd'];
     $email = $post['email'];
	$database->query('UPDATE usuarios SET email = :email WHERE idusuario = :userID');
	$database->bind(':email', $email);
	//$database->bind(':body', $body);
	$database->bind(':userID', $userID);
	$database->execute();
}
if(isset($post['submit'])){
	$username = $post['user'];
     $nameuser = $post['nameuser'];
     $passwd = $post['passwd'];
     $email = $post['email'];
	$database->query('INSERT INTO usuarios (idusuario, username, nombre, passwd, email, fktipousuario) VALUES (null, :user, :nameuser, :passwd, :email, 1)');
	$database->bind(':user', $username);
     $database->bind(':nameuser', $nameuser);
     $database->bind(':passwd', $passwd);
     $database->bind(':email', $email);
	$database->execute();
	if($database->lastInsertId()){
		echo '<p>Post Added!</p>';
	}
}

$database->query('SELECT * FROM usuarios /*WHERE idusuario = :iduser*/');
//$database->bind(':iduser', 1);
$rows = $database->resultset();
?>
<h1>Añadir Usuario</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
     <label>ID</label><br />
	<input type="text" name="userID" placeholder="ID" /><br />
	<label>Usuario</label><br />
	<input type="text" name="user" placeholder="usuario" /><br />
	<label>Nombre</label><br />
	<input type="text" name="nameuser" placeholder="nombre" /><br />
     <label>Password</label><br />
	<input type="text" name="passwd" placeholder="password" /><br />
     <label>Email</label><br />
	<input type="text" name="email" placeholder="email" /><br />
	<input type="submit" name="submit" value="Submit" id="submit" />
     <input type="submit" name="Actualizar" value="Actualizar" id="Actualizar" />
     <input type="submit" name="delete" value="delete" id="delete" />
</form>
<h1>usuario</h1>
<div>
<div>
<!-- Table -->
<table class="table" border="1">
      <thead>
          <tr>
          <th>ID</th>
          <th>usuario</th>
          <th>nombre</th>
          <th>email</th>
          </tr>
     </thead>
     <tbody>
<?php foreach($rows as $row) : ?>
          <tr>
          <td><?php echo $row['idusuario']; ?></td>
          <td><?php echo $row['username']; ?></td>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['email']; ?></td>
          </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>