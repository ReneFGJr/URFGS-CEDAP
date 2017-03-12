<?php
class comgrads extends CI_model
	{
	function form($data=array())
			{
				$nome = "Fulano da Silva Sauro";
				$sx = '<table width="100%" class="table" border=0>';
				$sx .= '<tr><td width="8%"></td><td width="8%"></td><td width="8%"></td><td width="8%"></td><td width="8%"></td><td width="8%"></td>';
				$sx .= '<td width="8%"></td><td width="8%"></td><td width="8%"></td><td width="8%"></td><td width="8%"></td><td width="8%"></td></tr>';
				$sx .= '</tr>';
				$sx .= '<td colspan=2">';
				$sx .= 'LOGO';
				$sx .= '</td>';

				$sx .= '<td colspan=10" align="center">';
				$sx .= '<b>
						UNIVERSIDADE FEDERAL DO RIO GRANDE DO SUL<br>
						FACULDADE DE BIBLIOTECONOMIA E COMUNICAÇÃO
						</b>';
				$sx .= '</td>';				
				$sx .= '</tr>';
				
				/* PARTE II */
				$sx .= '<tr bgcolor="#eeeeee">';
				$sx .= '<td colspan=12" align="center">';
				$sx .= 'SOLICITAÇÃO DE QUEBRA DE PRÉ-REQUISITO ';
				$sx .= '</td>';
				
				
				/* PARTE II */
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="left">';
				$sx .= '<h3>1 Identificação do Aluno</h3>';
				$sx .= '</td>';
				$sx .= '</tr>';
				
				$sx .= '<tr>';
				$sx .= '<td colspan=11" align="left">';
				$sx .= '<span class="small">Nome</span>';
				$sx .= '<br>';
				$sx .= '<span class="middle"><b>Fulano da Silva Sauro</b></span>';
				$sx .= '</td>';
				$sx .= '<td colspan=1" align="right" class="small">';
				$sx .= '<span class="small">Cartão</span>';
				$sx .= '<br>';
				$sx .= '<span class="middle"><b>00000000</b></span>';
				$sx .= '</td>';
				$sx .= '</tr>';
				
				$sx .= '<tr>';
				$sx .= '<td colspan=5" align="left">';
				$sx .= '<span class="small">Telefones</span>';
				$sx .= '<br>';
				$sx .= '<span class="middle"><b>xxxx.xxxxx.xxxxx</b></span>';
				$sx .= '</td>';
				$sx .= '<td colspan=7" align="right" class="small">';
				$sx .= '<span class="small">e-mail</span>';
				$sx .= '<br>';
				$sx .= '<span class="middle"><b>xxxx@xxxxx.com.br</b></span>';
				$sx .= '</td>';
				$sx .= '</tr>';
				
				/* PARTE III */
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="left">';
				$sx .= '<h3>2 Solicitação</h3>';
				$sx .= '</td>';
				$sx .= '</tr>';	
				
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="left">';
				$sx .= 'Eu, acima identificado, aluno do Curso de <b>Biblioteconomia</b> da UFRGS, solicito a seguinte quebra de pré-requisito:';			
				$sx .= '</td>';
				$sx .= '</tr>';	
				
				/********* DISCIPLINAS *******************/
				$sx .= '<tr class="small" style="border: 3px solid #000000;">';
				$sx .= '<th colspan="3"></th>';
				$sx .= '<th colspan="2" style="border: 3px solid #000000;">Código da disciplina</th>';
				$sx .= '<th colspan="7" style="border: 3px solid #000000;">Nome da disciplina</th>';
				$sx .= '</tr>';
				
				$sx .= '<tr style="border: 3px solid #000000;">';
				$sx .= '<td colspan="3">';
				$sx .= 'Pré-requisito a ser quebrado';
				$sx .= '</td>';
				$sx .= '<td colspan="2" style="border: 3px solid #000000;">&nbsp;</td>';
				$sx .= '<td colspan="7" style="border: 3px solid #000000;">&nbsp;</td>';
				$sx .= '</tr>';
				
				$sx .= '<tr style="border: 3px solid #000000;">';
				$sx .= '<td colspan="3">';
				$sx .= 'Disciplina(s) a ser(em) cursada(s) com a quebra do pré-requisito acima especificado';
				$sx .= '</td>';
				$sx .= '<td colspan="2" style="border: 3px solid #000000;">&nbsp;</td>';
				$sx .= '<td colspan="7" style="border: 3px solid #000000;">&nbsp;</td>';
				$sx .= '</tr>';
				
				/* PARTE IV */
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="left">';
				$sx .= '<h3>3 Justificativa</h3>';
				$sx .= '</td>';
				$sx .= '</tr>';	
				
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="left">';
				$sx .= '<div style="min-height: 150px;">';
				$sx .= '</div>';							
				$sx .= '</td>';
				$sx .= '</tr>';		
				
				/* PARTE V */
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="right">';
				$sx .= 'Porto Alegre, XX de xxxxxxxxxxx de 2017.';
				$sx .= '</td>';
				$sx .= '</tr>';								
												
				/* PARTE V */
				$sx .= '<tr>';
				$sx .= '<td colspan=12" align="center">';
				$sx.= '_____________________________________<br>';
				$sx .= '<b>'.$nome.'</b><br>';
				$sx .= '<span class="small">Assinatura do Requerente</span>';
				$sx .= '</td>';
				$sx .= '</tr>';								

								$sx .= '</table>';
				return($sx);
			}
	}
?>
