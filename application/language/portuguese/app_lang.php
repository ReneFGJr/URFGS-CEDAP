<?php
// This file is part of the Brapci Software. 
// 
// Copyright 2015, UFPR. All rights reserved. You can redistribute it and/or modify
// Brapci under the terms of the Brapci License as published by UFPR, which
// restricts commercial use of the Software. 
// 
// Brapci is distributed in the hope that it will be useful, but WITHOUT ANY
// WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
// PARTICULAR PURPOSE. See the ProEthos License for more details. 
// 
// You should have received a copy of the Brapci License along with the Brapci
// Software. If not, see
// https://github.com/ReneFGJ/Brapci/tree/master//LICENSE.txt 
/* @author: Rene Faustino Gabriel Junior <renefgj@gmail.com>
 * @date: 2015-12-01
 */
if (!function_exists(('msg')))
	{
		function msg($t)
			{
				$CI = &get_instance();
				if (strlen($CI->lang->line($t)) > 0)
					{
						return($CI->lang->line($t));
					} else {
						return($t);
					}
			}
	}
	
/* Login */
$lang['login_enter'] = 'Entrar';
$lang['login_name'] = 'Informe seu login';
$lang['login_password'] = 'Informe sua senha';
$lang['login_enter'] = 'Entar';
$lang['login_social'] = 'Logue com uma conta existente (recomendado)';
$lang['your_passoword'] = 'sua senha';

$lang['bt_new'] = 'novo';
$lang['bt_search'] = 'busca';
$lang['bt_clear'] = 'limpa filtro';

$lang['proposta_nova'] = 'nova proposta';
$lang['not_register'] = 'nenhum registro';

$lang['dc:creator'] = 'Autor';
$lang['dc:language'] = 'Idioma';

$lang['pt_BR'] = 'Português';
$lang['us'] = 'Inglês';
$lang['dc:title'] = 'Título';
$lang['dc:format'] = 'Formato';

$lang['folders'] = 'Pastas de Trabalho';
$lang['folder'] = 'Pasta de Trabalho';

$lang['collections'] = 'Coleções';
?>
