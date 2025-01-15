<div class="wrap">
	<h1>Mi Cuenta en Mercado Libre</h1>
	<p>Aquí podrás ver los detalles de tu cuenta de Mercado Libre:</p>

	<?php
	$access_token = Auth_Handler::handle_callback();

		echo "El Access Token es: $access_token";

	?>
</div>

