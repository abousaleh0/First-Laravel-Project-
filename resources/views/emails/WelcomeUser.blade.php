<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to {{ config('app.name') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: Arial, sans-serif; color: #1f2937;">
	<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="padding: 32px 16px;">
		<tr>
			<td align="center">
				<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden;">
					<tr>
						<td style="padding: 32px;">
							<h1 style="margin: 0 0 24px; color: #111827;">Welcome, {{ $user->name ?? 'there' }}!</h1>

							<p style="line-height: 1.6;">Thank you for joining {{ config('app.name') }}. Your account is ready to use.</p>
							<p style="line-height: 1.6;">Start organizing your tasks and keep your work moving forward.</p>

							<p style="margin: 32px 0; text-align: center;">
								<a href="{{ url('/dashboard') }}" style="display: inline-block; padding: 12px 24px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 6px;">Go to your dashboard</a>
							</p>

							<p style="line-height: 1.6;">If you have any questions, feel free to contact our support team.</p>
							<p style="margin-bottom: 0;">Regards,<br>{{ config('app.name') }}</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
