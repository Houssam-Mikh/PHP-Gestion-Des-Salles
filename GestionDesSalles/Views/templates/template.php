<html>
<head>
<meta charset="utf-8"/>
<script src="public/JS/AJAX.js"></script>
<link rel="stylesheet" type = "text/css" href ="public/CSS/style2.css" />
</head>
<style>
a.blan {color: white; text-decoration: none}
td {padding:0.5cm;}
td.droite {text-align : right}
body {margin : 2cm; margin-top: 0pt; color:#000066;}
div.section {background-color : #990000; color : white; font-size: 18px; margin-top: 1cm; margin-bottom: 1cm; padding : 0.5mm; padding-left : 3mm;   font-weight : bold}
.msg {border-width : 1px; border-color: #990000; border-style:groove; padding : 5mm; line-height: 150%; color:#000066; text-align:justify}
.button {font-weight :bold; color : #990000; text-align : right; text-decoration:none}
tr.h{background-color : #990000; color : white}
tr.0 {background-color : #EEEEEE}
tr.1 {background-color : #DDDDDD}
.titre {color: #990000; text-align : center; font-size : 16pt; font-family: Georgia, "Times New Roman", Times, serif; }
.titre2 { text-align : center; font-size : 12pt; font-family: Georgia, "Times New Roman", Times, serif;}
</style>
<body >
<img src= 'public/images/fsdm.jpg' border = '0' hspace = '20' vspace = '20' align = 'left' />
<div style = 'color: green'>
<span style = 'font-size : 18pt; font-weight:bold'>SMI6</span><br />
Facult&eacute; des Sciences Dhar El Mahraz, F&egrave;s </div>


<h4 align = 'right' style = 'color : #FFFFFF; background : #990000'>
&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
 &nbsp;&nbsp;
</h4>

<div align= "right">
<?php if (isset($_SESSION["user"])){?>
User:  <?= strtolower($_SESSION["user"]) ?> &nbsp;&nbsp;&nbsp;&nbsp;
<a href = "index.php?action=deconnexion">Déconnexion</a> 
<?php } else {?>Non Connecté<?php }?>&nbsp;&nbsp;   &nbsp;&nbsp;

</div>
<br />



 <?= $view ?>


<br /><hr color = "#990000"/><div style = 'color: #990000; text-align: center; font-size: 8pt'>&copy; Copyright: SMI6 2022<br />Facult&eacute; des Sciences Dhar El Mahraz</br>smi6@usmba.ac.ma</div>
</body>
</html>
