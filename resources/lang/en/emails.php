<?php

return
	[
		'forgot_email' => 'Science Clinic Reset Password',
		'forgot_email_body' => '<p style="font-family: "Poppins-SemiBold";">Hello :USERNAME,</p><br/> :HTMLTABLE',

		'template' => '<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Science Clinic</title>
			<style>
				@font-face {
					font-family: "Poppins-Regular";
					src: url(' . URL::to('/') . '/mail-template/fonts/Poppins-Regular.ttf);
				}

				@font-face {
					font-family: "Poppins-SemiBold";
					src: url(' . URL::to('/') . '/mail-template/fonts/Poppins-SemiBold.ttf);
				}

				body {
					padding: 0;
					margin: 0;
					font-family: "Poppins-Regular";
					font-size: 14px;
				}

				.border tr,
				.border td {
					border-bottom: 1px solid #ccc;
					padding: 8px;
				}

				.border {
					border-spacing: 0;
				}
			</style>
		</head>

		<body>
			<table style="    width: 600px;  margin: 20px auto;    background: #F8F8FF;    font-size: 14px;    padding: 8px 20px;    border-radius: 15px;">
				<tr>
					<td>
					:BODYCONTENT
					</td>
				</tr>
			</table>
			<table style="    width: 600px;  margin: 20px auto;    background: #ececf9;    font-size: 12px;    padding: 15px;    border-radius: 15px;">
				<tr>
					<td style="text-align: center;">' . date('Y') . ' © Science Clinic, All Right Reserved</td>
				</tr>
			</table>
		</body>
		</html>',
	];