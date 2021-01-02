<?php
function getHeader() {
	$theHeader = "
	<html>
	<body>
		<p style='font-size: 10px; font-family: Arial; font-style: italic;'>NOTE: You are receiving this email because you contacted our directory.</p>
			<table width='560' border='1' bordercolor='#901b4f' cellspacing='0' cellpadding='0' style='border: 2px solid #901b4f;'>
				<tr>
					<td>
						<table width='560' border='0' cellspacing='0' cellpadding='0' align='center'>
							<tr bgcolor='#C2367D'>
								<td width='560' height='148' valign='top'><a href='http://www.purebizness.net' target='_blank'><img src='http://www.purebizness.net/images/emailer/header.png' alt='Purebizness Adult Directory Logo' width='560' height='148' border='0' style='display: block;'></a></td>
							</tr>
							<tr bgcolor='#C2367D'>
								<td align='center' valign='top' height='20' style='padding: 5px; color: #FFFFFF; font-family: Arial; border-top: 2px solid #901b4f; border-bottom: 2px solid #901b4f;'><strong>Contact Form Message</strong></td>
							</tr>
							<tr>
								<td valign='top' style='padding: 5px; font-family: Arial;'>
	";			
	return $theHeader;
}

function getFooter() {
	$theFooter = "
								</td>
							</tr>
							<tr>
								<td height='20' align='center' valign='middle' bgcolor='#C2367D' style='border-top: 2px solid #901b4f;'><a href='http://www.purebizness.net' target='_blank' style='color: #FFFFFF; font-size: 10px; font-family: Arial; text-decoration: none;'><strong>Purebizness Adult Directory</strong></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		<p style='font-size: 8px; font-family: Arial;'>&copy; ".gmdate("Y")." The Purebizness Team</p>
	</body>
	</html>
	";			
	return $theFooter;
}
?>