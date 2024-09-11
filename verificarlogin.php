<?php
if( isset($_SESSION['s_id']) && !empty($_SESSION['s_id']) && $_SESSION['s_id'] > 0  )
{
$s_id 	= $_SESSION['s_id'];
$s_nome	= ((!empty($_SESSION['s_nome']))? 	$_SESSION['s_nome']	: null);
$s_idr	= ((!empty($_SESSION['s_idr']))? 	$_SESSION['s_idr']	: null);
}
else
{
$s_id 		= 0;
$s_nome 	= null;
$s_idr 		= null;
echo  $mensg = '<script type="text/javascript">window.location.href= "auth.php";</script>';
}