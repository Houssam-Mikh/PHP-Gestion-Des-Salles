<h1>Autentification</h1>
<hr />
<br />

<table border = "1" bordercolor="#996633" >
<tr bgcolor="DDDDDD">
<td width ="50%">
<b> Je possède un token </b>
</td>

<td>
<b>Je ne possède pas de token </b>
</td>
</tr>
<tr>
<td>

Entrez votre token pour vous connecter:

<form  action = "" method = "post" >
<pre>

Token    <input name ="token" type = "text" /> <span class="Err"><?= $erreur["token"] ?? "" ?> </span> 


         <input type = "submit" value = "Connexion avec un token" />
</pre>
</form>

</td>
<td>

Entrez votre e-mail académique pour recevoir un token:
<form action = "" method = "post" >
<pre>

Email Académique    <input name ="email" type = "text" /> <span class="Err"><?= $erreur["email"] ?? "" ?> </span> 


         <input type = "submit" value = "Envoyer un lien de connexion à ma boite email" />
</pre>
</form>
</td>
</tr>

</table>